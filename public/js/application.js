$(function() {
    $('.upvote').click(function(e) {
        var dataID = $(this).data('id');
        e.preventDefault();
        sendVote('up', dataID);
    });

    $('.downvote').click(function(e) {
        var dataID = $(this).data('id');
        e.preventDefault();
        sendVote('down', dataID);
    });

    function sendVote(voteType, dataID) {
        $.ajax({
            url: url + "vote/" + voteType + "/" + dataID, 
            dataType: "json"
            })
            .done(function(result) {
                if(result.status == 'success') {
                    $('#upvote-' + dataID).html(result.upvotes);
                    $('#downvote-' + dataID).html(result.downvotes);
                } else {
                    alert('Vote failed. Have you already voted for this quote?');
                }
            })
    }
});