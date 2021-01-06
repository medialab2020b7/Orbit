$(function () {
    const token = $("#token").val();

    const container = document.getElementById("globeArea");
    // const citySelect = $("#city_id");
    const emotionSelect = $("#emotion_id");
    // const formSubmit = $("#form-submit");
    const storiesList = $("#historias");
    const listElementTemplate = storiesList.find(".story");

    const initialCountry = "PT";
    let filterParams = {
        // city: "",
        emotion: "",
        baseHistories: [],
        selectedOnModal: null,
        histories: []
    };

    let selectedCountryCode = "PT";
    const soundButton = $("#btn-sound");
    const showOnMapButton = $("#btn-onmap");
    const clearFiltersButton = $("#clearFilters");

    const botaoClicar = $("#btn-story");

    const countrySelect = $("#country");
    const citySelect = $("#city");
    let selectedCity = "";

    /* Start Globe */
    let controller = null;

    const makeController = () => {
        var configs = {
            control: {
                stats: false,
                disableUnmentioned: false,
                lightenMentioned: false,
                inOnly: false,
                outOnly: false,
                initCountry: initialCountry,
                halo: true
            },
            color: {
                surface: 0xFFFFFF,
                selected: null,
                in: 0x154492,
                out: 0xDD380C,
                halo: 0xFFFFFF,
                background: null
            },
            brightness: {
                ocean: 0.5,
                mentioned: 0.5,
                related: 0.5
            }
        };

        return new GIO.Controller(container, configs);
    };

    controller = makeController();
    controller.setInitCountry(initialCountry);
    controller.init();

    /** Update globe with data */
    const updateGlobe = (histories) => {
        controller.clearData();
        let data = [];

        histories.forEach(h => {
            let connections = h.histories;
            let e = h.location.country.code;
            connections.forEach(c => {
                let i = c.location.country.code;
                data.push({e, i, v: 100});
            });
        });

        controller.addData(data);
    };

    /* Fetch all histories to make globe connections */
    const fetchHistories = () => {
        let params = "";

        // if(filterParams.city !== ""){
        //     if(params.length > 0)
        //         params += "&";
        //     params += `city=${filterParams.city}`;
        // }

        if (filterParams.emotion !== "") {
            if (params.length > 0)
                params += "&";
            params += `emotion=${filterParams.emotion}`;
        }

        //console.log(filterParams); console.log(params);

        axios.get(`/api/histories?${params}`).then(response => {
            //console.log("Loaded histories"); console.log(response); console.log(response.data);  //Testing
            let histories = response.data;
            filterParams.histories = histories;
            let filteredStories = [];
            let bhs = filterParams.baseHistories;
            histories.forEach(h => {
                if (h.location.country.code === selectedCountryCode) {
                    if(bhs.length == 0)
                        filteredStories.push(h);
                    else {
                        bhs.forEach(b => {
                            if(b.id == h.id)
                                filteredStories.push(h);
                        });
                    }
                }
            });

            updateGlobe(filteredStories);
            storiesList.empty();
            filteredStories.forEach(e => createStoryListElement(e));

        }).catch(err => {
            console.log("ERROR loaded histories");  //Testing
            console.log(err);
            if (err.response) console.log(err.response);
            else if (err.request) console.log(err.request);
        });
    };

    //Fetch cities to select
    // const fetchCities = (countryCode) => {
    //     citySelect.empty();
    //     citySelect.prop("disabled", true);

    //     axios.get('/api/cities/' + countryCode).then(response => {
    //         console.log("Loaded cities"); console.log(response); console.log(response.data);    //Testing
    //         const cities = response.data;

    //         //Add to options
    //         citySelect.append($('<option>').val("").text("All Cities"));
    //         cities.forEach(c => {
    //             citySelect.append($('<option>').val(c.id).text(c.name));
    //         });
    //         citySelect.prop("disabled", false);


    //     }).catch(err => {
    //         console.log("ERROR Loaded cities");
    //         console.log(err);
    //         if (err.response) console.log(err.response);
    //         else if (err.request) console.log(err.request);
    //     });
    // };

    // On Change country on Globe
    controller.onCountryPicked(function (selectedCountry) {
        selectedCountryCode = selectedCountry.ISOCode;

        let hasBase = filterParams.baseHistories.length > 0;
        let newHistoriesID = [];
        let newHistories = [];

        filterParams.baseHistories.forEach(h => {
            let connected = h.histories;
            connected.forEach(c => {
                let country = c.location.country.code;
                if(country == selectedCountryCode)
                newHistoriesID.push(c.id);
            });
        });

        filterParams.histories.forEach(h => {
            if(newHistoriesID.includes(h.id))
                newHistories.push(h);
        });

        filterParams.baseHistories = newHistories;

        if(hasBase && filterParams.baseHistories.length == 0)
            alert("There is no connected history to current history. Showing all histories on that location.");

        fetchHistories();
    });

    //On Emotion Selected
    emotionSelect.on("change", function () {
        const emotion = $("#emotion_id option:selected").val();
        filterParams.emotion = emotion;
        filterParams.baseHistories = [];   //Reset selected history
        fetchHistories();   //Because removed submit button
    });

    // USE THIS FUNCTION AFTER CREATING A STORY, SEND IN THE COUNTRY CODE OF THE STORY ------------- PODES USAR ISTO
    function switchCountryAndUpdateStories(countryCode, emotionId) {
        //Sync globe
        selectedCountryCode = countryCode;
        controller.switchCountry(countryCode);

        //Update filter of emotion
        filterParams.emotion = emotionId;
        emotionSelect.val(emotionId);

        //Reload histories
        fetchHistories();
    }

    //On City Selected
    // citySelect.on("change", function() {
    //     const city = $( "#city_id option:selected" ).val();
    //     filterParams.city = city;
    // });

    //On Submit Filter
    // formSubmit.on( "click", function() {
    //     fetchHistories();
    // });

    // Histories
    const createStoryListElement = data => {
        const newElemet = listElementTemplate.clone();
        if (!newElemet.hasClass("story")) {
            newElemet.addClass("story");
        }
        newElemet.attr('data-id', data.id);
        const storyEmotionName = newElemet.find(".story-emotion-name");
        const storyDescription = newElemet.find(".story-description");
        const storyDate = newElemet.find(".story-date");
        const storyUser = newElemet.find(".story-user");
        storyEmotionName.text(data.emotion.name);
        storyDescription.text(data.description);
        storyDate.text(data.history_date);
        storyUser.text(data.user.name);
        storiesList.append(newElemet);
    };

    // Get Selected Story
    storiesList.on('click', 'a.story', function () {
        //console.log("Clicked on a Story");
        let clickedStoryId = $(this).attr('data-id');

        axios.get('/api/historiesById/' + clickedStoryId).then(response => {
            const clickedStory = response.data;
            //console.log(clickedStory);

            filterParams.selectedOnModal = clickedStory;

            $("#storyDataModal .modal-title").text(clickedStory.emotion.name);
            $("#storyDataModal .modal-description").text(clickedStory.description);
            $("#storyDataModal .modal-story-user").text(clickedStory.user.name);
            $("#storyDataModal .modal-story-date").text(clickedStory.history_date);
            let sound = new Audio('sounds/' + clickedStory.emotion.sound);
            sound.play();

        }).catch(err => {
            console.log(err)

            filterParams.selectedOnModal = null;
        });
    });

    /** CREATE HISTORY */
    countrySelect.on("change", function() {
        const country = $( "#country option:selected" ).val();

        citySelect.empty();
        citySelect.prop("disabled", true);

        if(country === "")
            return;

        axios.get('/api/cities/' + country).then(response => {
            //console.log("Loaded cities"); console.log(response); console.log(response.data);    //Testing
            const cities = response.data;

            //Add to options
            citySelect.prop("disabled", false);
            if(cities.length > 0)
                selectedCity = cities[0].id;
            cities.forEach(c => {
                citySelect.append(`<option value="${c.id}">${c.name}</option>`);
            });


        }).catch(err => {
            console.log("ERROR Loaded cities");
            console.log(err);
            if (err.response) console.log(err.response);
            else if (err.request) console.log(err.request);
        });
    });

    citySelect.on("change", function() {    //jquery getting selected not working
        selectedCity = this.value;
    });

    botaoClicar.on("click", function () {
        const description = $("#description").val();
        // const user_id = $("#user_id").val();
        const history_date = $("#history_date").val();
        // const country = $("#country").val();
        const city = selectedCity;
        // const active = $("#active").val();
        const emotion_id = $("#emotion_id_form option:selected").val();

        if(!description || !history_date || !city || !emotion_id){
            alert("Please fill all fields.");
            return;
        }

        /*const historias = $("#historias");
        const historiaUm = historias.first();*/

        axios.post("/api/histories", {
            api_token: token,
            // user_id,
            description,
            history_date,
            // country,
            city,
            // active,
            emotion_id
        }).then(response => {
            const data = response.data;
            //console.log(data);

            filterParams.baseHistories = [data];   //Only show the created history on globe and its connections
            switchCountryAndUpdateStories(data.location.country.code, data.emotion_id, data.id);
        }).catch(err => {
            console.log(err)
        });

        $('#submitStoryModal').modal('hide');
    });

    //Update globe when selecting a history on modal
    showOnMapButton.on("click", function () {
        if(filterParams.selectedOnModal == null){
            alert("Data of history not loaded yet.");
            return;
        }

        let h = filterParams.selectedOnModal;
        filterParams.baseHistories = [h];   //Only show the history on globe and its connections
        switchCountryAndUpdateStories(h.location.country.code, h.emotion_id, h.id);

        $('#storyDataModal').modal('hide');
    });

    //Play sound
    soundButton.on("click", function () {
        if(filterParams.selectedOnModal == null){
            alert("Data of history not loaded yet.");
            return;
        }

        let h = filterParams.selectedOnModal;
        let sound = h.emotion.sound;
        let file = soundsFolder + "/" + sound;

        let audio = new Audio(file);
        audio.play();
    });

    //Clear all filters
    clearFiltersButton.on("click", function () {
        filterParams = {
            // city: "",
            emotion: "",
            baseHistories: [],
            selectedOnModal: null,
            histories: []
        };
        selectedCity = "";

        fetchHistories();
    });






    //Bootstrap code
    fetchHistories();
    // fetchCities(initialCountry);
});


