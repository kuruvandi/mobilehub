<div class="container">
    <div class="panel-body">
        <ul class="list-group">
        </ul>
    </div>
</div>

<script type="text/javascript">

    function getTagsString($tags)
    {
        var str = "";
        for (var i = 0; i < $tags.length; i++) {
            str += "<button type='button' class='btn btn-info btn-xs' title='Approved' text='Category'>" + $tags[i] + "</button>&nbsp";
        }
        return str;
    }

    $(document).ready(function() {
        $.get("/MobileHub/index.php/api/question/recent", function(resultsData) {
            resultsData = jQuery.parseJSON(resultsData);
            loadUI(resultsData);
            return true;
        });
    });

    function loadUI(resultsData) {
        for (var i = 0; i < resultsData.results.length; i++) {
            var result = resultsData.results[i];
            dateAsked = result.askedOn.split(' ');
            var listItem = "<li class='list-group-item' style='margin-bottom: 5px;'>"
                    + "<div class='row' style='margin-right: -40px;'><div class='col-xs-2 col-md-1'>"
                    + "<img src='http://placekitten.com/80/80' class='img-circle img-responsive' alt='' /></div>"
                    + "<div class='col-xs-10 col-md-9'><div>"
                    + "<a href='question/show/?id=" + result.questionId + "'>" + result.questionTitle + "</a>"
                    + "<div class='mic-info'> Asked by <a href='#'>" + result.askerName + "</a> on " + dateAsked[0] + "</div></div>"
                    + "<div class='comment-text'><br>"
                    + result.questionDescription + "</div>"
                    + "<div class='action'>"
                    + getTagsString(result.tags)
                    + "</div></div>" //tags
                    + "<div class='col-md-2'><div class='vote-box' title='Votes'><span class='vote-count'>"
                    + result.votes + "</span><span class='vote-label'>votes</span></div>"
                    + "<div class='ans-count-box' title='Answers'><span class='ans-count'>"
                    + result.answerCount + "</span>"
                    + "<span class='ans-label'>answers</span></div></div></div></li>";
            $("ul.list-group")
                    .append(listItem);
        }
    }
</script>