$(function() {
    const token = $("#token").val();

    const botaoClicar = $("#btn-story");

    botaoClicar.on("click", function(){
        const description = $("#description").val();
        const user_id = $("#user_id").val();
        const history_date = $("#history_date").val();
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
            history_date,
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

        $('#submitStoryModal').modal('hide');

    });

    let clickedStoryId = 0;
    $(".story").click(function(e) {
        clickedStoryId = $(this).attr('data-id');

        axios.get("/api/histories").then(response => {
            const data = response.data;
            const clickedStory = data[clickedStoryId-1];
            console.log(clickedStory); //isto pode dar erros, mas tentei de bué formas e n consegui de outra maneira

            $("#storyDataModal .modal-title").text(clickedStory.emotion_id);
            $("#storyDataModal .modal-description").text(clickedStory.description);
            $("#storyDataModal .modal-story-user").text(clickedStory.user_id);
            $("#storyDataModal .modal-story-date").text(clickedStory.history_date);
            $("#storyDataModal .modal-story-sound").text("add sound here");

        }).catch(err => {
            console.log(err)
        });
    });
});
