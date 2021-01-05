$(function() {
    let clickedStoryId = 0;
    $(".story").click(function(e) {
        clickedStoryId = $(this).attr('data-id');

        axios.get('/api/historiesById/' + clickedStoryId).then(response => {
            const clickedStory = response.data;
            console.log("Clicked on this story: " + clickedStory);

            $("#storyDataModal .modal-title").text(clickedStory.emotion.name);
            $("#storyDataModal .modal-description").text(clickedStory.description);
            $("#storyDataModal .modal-story-user").text(clickedStory.user.name);
            $("#storyDataModal .modal-story-date").text(clickedStory.history_date);
            $("#storyDataModal .modal-story-sound").text("add sound here");

        }).catch(err => {
            console.log(err)
        });
    });
});
