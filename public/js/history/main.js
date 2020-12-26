$(function() {
    const token = $("#token").val();

    const botaoClicar = $("#btn-story");

    botaoClicar.on("click", function(){
        console.log('alooo');
        const description = $("#description").val();
        const user_id = $("#user_id").val();
        const history_day = $("#day").val();
        const history_month = $("#month").val();
        const history_year = $("#year").val();
        const country = $("#country").val();
        const city = $("#city").val();
        const active = $("#active").val();
        const emotion_id = $("#emotion_id").val();

        /*const historias = $("#historias");
        const historiaUm = historias.first();*/

        axios.post("/api/histories", {
            api_token: token,
            user_id,
            description,
            history_day,
            history_month,
            history_year,
            country,
            city,
            active,
            emotion_id
        }).then(response => {
            const data = response.data;
            console.log(data);

            /*const novaHistoria = historiaUm.clone();
            novaHistoria.text(data.history.description + " - " + data.history.country + " - " + data.history.city);
            historias.append(novaHistoria);*/
        }).catch(err => {
            console.log(err)
        });

        document.getElementById("submitStoryModal").style.display = "none";
    });
});
