$(function() {
    let profileStoryId = 0;
    $(".story").click(function(e) {
        profileStoryId = $(this).attr('data-id');

        axios.get('/api/historiesById/' + profileStoryId).then(response => {
            const clickedStory = response.data;
            console.log("Clicked on this story: " + clickedStory);

            $("#profileStoryModal .modal-title").text(clickedStory.emotion.name);
            $("#profileStoryModal .modal-description").text(clickedStory.description);
            $("#profileStoryModal .modal-story-user").text(clickedStory.user.name);
            $("#profileStoryModal .modal-story-date").text(clickedStory.history_date);
            $("#profileStoryModal .modal-story-sound").text("add sound here");

        }).catch(err => {
            console.log(err)
        });
    });
});
