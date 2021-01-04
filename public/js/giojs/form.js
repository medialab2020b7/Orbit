$(function() {
    /*const countrySelect = $("#country_id");
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
    });*/
});
