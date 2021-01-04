$(function() {
    const container = document.getElementById( "globeArea" );

    let data = [];

    const makeController = () => {
        var configs = {
            control: {
                stats: false,
                disableUnmentioned: false,
                lightenMentioned: false,
                inOnly: false,
                outOnly: false,
                initCountry: "PT",
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

    const clearData = () => {
        data = [];
    };

    const addConnection = (e, i, v ) => {
        data.push({e,i,v});
    };

    const fetchHistories = () => axios.get('/api/histories').then(response => {
        //console.log("Loaded histories"); console.log(response); console.log(response.data);  //Testing
        let histories = response.data;

        histories.forEach(h => {
            let connections = h.histories;
            connections.forEach(c => {
                // addConnection();
                //console.log(c);
            });
        });

            //TODO - get cities and countries info with the history info. (maybe use a mutator?)

        clearData();

    }).catch(err => {
        console.log("ERROR loaded histories");  //Testing
        console.log(err);
        if (err.response) console.log(err.response);
        else if (err.request) console.log(err.request);
    });

    let controller = makeController();
    controller.setInitCountry("PT");
    controller.init();

    fetchHistories();

    //CITY SELECT DATA
    const citySelect = $("#city_id");
    controller.onCountryPicked(function (selectedCountry) {

        citySelect.empty();
        citySelect.prop("disabled", true);

        axios.get('/api/cities/' + selectedCountry.ISOCode).then(response => {
            console.log("Loaded cities"); console.log(response); console.log(response.data);    //Testing
            const cities = response.data;

            //Add to options
            citySelect.prop("disabled", false);
            cities.forEach(c => {
                citySelect.append($('<option>').val(c.code).text(c.name));
            });


        }).catch(err => {
            console.log("ERROR Loaded cities");
            console.log(err);
            if (err.response) console.log(err.response);
            else if (err.request) console.log(err.request);
        });
    });

    //EMOTION FILTER
    const emotionSelect = $("#emotion_id");
    const storiesList = $("#historias");
    let listElementTemplate = storiesList.find(".story");

    function createStoryListElement(data) {
        const newElemet = listElementTemplate.clone();
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
    }

    emotionSelect.on("change", function() {
        const emotion = $( "#emotion_id option:selected" ).val();

        if(emotion === "")
            return;

        axios.get('/api/historiesByEmotion/' + emotion).then(response => {
            const stories = response.data;
            storiesList.empty();
            stories.forEach(e => createStoryListElement(e));

        }).catch(err => {
            console.log("ERROR Loaded cities");
            console.log(err);
            if (err.response) console.log(err.response);
            else if (err.request) console.log(err.request);
        });
    });

});
