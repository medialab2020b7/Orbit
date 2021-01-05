$(function() {
    const container = document.getElementById( "globeArea" );
    // const citySelect = $("#city_id");
    const emotionSelect = $("#emotion_id");
    // const formSubmit = $("#form-submit");
    const storiesList = $("#historias");
    const listElementTemplate = storiesList.find(".story");

    const initialCountry = "PT";
    const filterParams = {
        // city: "",
        emotion: ""
    };

    let selectedCountryCode = "PT";

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

        return new GIO.Controller( container, configs );
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
                data.push({e,i,v: 100});
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

        if(filterParams.emotion !== ""){
            if(params.length > 0)
                params += "&";
            params += `emotion=${filterParams.emotion}`;
        }

        //console.log(filterParams); console.log(params);

        axios.get(`/api/histories?${params}`).then(response => {
            //console.log("Loaded histories"); console.log(response); console.log(response.data);  //Testing
            let histories = response.data;
            let filteredStories = [];
            histories.forEach(h => {
                if(h.location.country.code === selectedCountryCode) {
                    filteredStories.push(h);
                }
            });

            updateGlobe(histories);
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
        fetchHistories();
    });

    //On Emotion Selected
    emotionSelect.on("change", function() {
        const emotion = $( "#emotion_id option:selected" ).val();
        filterParams.emotion = emotion;
        fetchHistories();   //Because removed submit button
    });

    //On City Selected
    // citySelect.on("change", function() {
    //     const city = $( "#city_id option:selected" ).val();
    //     filterParams.city = city;
    // });

    //On Submit Filter
    // formSubmit.on( "click", function() {
    //     fetchHistories();
    // });

    //Bootstrap code
    fetchHistories(initialCountry);
    // fetchCities(initialCountry);

    // Histories
    const createStoryListElement = data => {
        const newElemet = listElementTemplate.clone();
        if(!newElemet.hasClass("story")) {
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

});
