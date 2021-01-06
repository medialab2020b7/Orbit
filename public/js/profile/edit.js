$(function() {
    const token = $("#token").val();

    const countrySelect = $("#form-country_id");
    const citySelect = $("#form-city_id");

    const formName = $("#form-name");
    const formDescription = $("#form-description");
    const formAvatar = document.getElementById("form-avatar");;
    const formSend = $("#form-submit");

    let selectedCity = "";

    countrySelect.on("change", function() {
        const country = $( "#form-country_id option:selected" ).val();

        citySelect.empty();
        citySelect.prop("disabled", true);
        
        if(country === "")
            return;

        axios.get('/api/cities/' + country).then(response => {
            console.log("Loaded cities"); console.log(response); console.log(response.data);    //Testing
            const cities = response.data;

            //Add to options
            citySelect.prop("disabled", false);
            citySelect.append('<option selected="selected" value="">Choose City</option>');
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

    formSend.on( "click", function() {
        let name = formName.val();
        let description = formDescription.val();

        let formData = new FormData();
        formData.append("api_token", token);
        formData.append("name", name);
        formData.append("description", description);
        formData.append("city_id", selectedCity);

        if(formAvatar.files && formAvatar.files.length > 0)
            formData.append("avatar", formAvatar.files[0]);

        axios.post('/api/profile', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
        }).then(response => {
            console.log("Updated profile"); console.log(response); console.log(response.data);    //Testing
            alert("Profile was updated.");
        }).catch(err => {
            console.log("ERROR Update profile");
            console.log(err);
            if (err.response) console.log(err.response);
            else if (err.request) console.log(err.request);
        });
    });
});  