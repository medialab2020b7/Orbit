$(function() {
    const countrySelect = $("#country_id");
    const citySelect = $("#city_id");

    countrySelect.on("change", function() {
        const country = $( "#country_id option:selected" ).val();

        citySelect.empty();
        citySelect.prop("disabled", true);

        if(country === "")
            return;

        axios.get('/api/cities/' + country).then(response => {
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

    const emotionSelect = $("#emotion_id");
    const storiesList = $("#historias");
    let listElementTemplate = storiesList.find(".story");

    function createStoryListElement(data) {
        const newElemet = listElementTemplate.clone();
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
