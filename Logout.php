<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>

<style>

body{
	margin: 0;
	padding: 0;
	font-family: sans-serif;
	/*background-image: url(https://picsum.photos/1200/800?image=1074);*/
	background-size: cover;
	background-position: center;
	position: relative;
	height: 100vh;
}


.box{
	position: absolute;
	top: 10%;
	left: 50%;
	transform: translate(-50%, 0%);
	width: 400px;
	padding: 40px;
	background: rgba(0, 0, 0, .8);
	box-sizing: border-box; 
	box-shadow: 0 15px 25px rgba(0, 0, 0, .5);
	border-radius: 10px;
}

.box h2{
	margin: 0 0 30px;
	padding: 0;
	color: #fff;
}
.box .inputBox{
	position: relative;
}

.box .inputBox input{
	text-align: center;
	width: 100%;
	padding: 10px 0;
	font-size: 16px;
	color: #fff;
	letter-spacing: 2;
	margin-bottom: 30px;
	border: none;
	border-bottom: 1px solid #fff;
	outline: none;
	background: transparent;

}

.box .inputBox label{
	position: absolute;
	top: 0;
	left: 0;
	padding: 10px 0;
	font-size: 16px;
	color: #fff;
	pointer-events: none;
	transition: .5s;
}

.box .inputBox input:focus ~ label,
.box .inputBox input:valid ~ label{
	top: -18px;
	left: 0;
	color: #03a9f4;
	font-size: 12px;
}

.box input[type="submit"]{
	background: transparent;
	border: none;
	outline: none;
	color: #fff;
	background: #03a9f4;
	padding: 10px 20px;
	cursor: pointer;
	border-radius: 5px;
}



.comment-form-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 20px;
	border-radius: 2px;
}

.input-row {
	margin-bottom: 20px;
}

.input-field {
	width: 97%;
	border-radius: 2px;
	padding: 10px;
	border: #e0dfdf 1px solid;
}

.btn-submit {
	padding: 10px 20px;
	background: #333;
	border: #1d1d1d 1px solid;
	color: #f0f0f0;
	font-size: 0.9em;
	width: 100px;
	border-radius: 2px;
	cursor: pointer;
}

ul {
	list-style-type: none;
}

.comment-row {
	border-bottom: #e0dfdf 1px solid;
	margin-bottom: 15px;
	padding: 15px;
}

.outer-comment {
	padding: 10px;
	border: #dedddd 1px solid;
	background: #FFF;
}

span.commet-row-label {
	font-style: italic;
}

span.posted-by {
	color: #09F;
}

.comment-info {
	font-size: 0.8em;
}

.comment-text {
	margin: 10px 0px;
}

.btn-reply {
	font-size: 0.8em;
	text-decoration: underline;
	color: #888787;
	cursor: pointer;
}

#comment-message {
	margin-left: 20px;
	color: #189a18;
	display: none;
}

.like-unlike {
	vertical-align: text-bottom;
	cursor: pointer;
}

.post-action {
	margin-top: 15px;
    font-size: 0.8em;
}
span.posted-at {
    color: #929292;
}
</style>



<title>Comment System using PHP and Ajax</title>

<script src="jquery-3.2.1.min.js"></script>
<meta charset="utf-8">
</head>
    
    
    <body style="background: rgba(243, 241, 241, 0.918)background-size: cover; background-position: center">
    
        <div id="home">
         
            <div class="box" style="width:80%">

                <h2>WELCOME! <?php echo $_SESSION['firstname'];   ?>, You Can Add Comments To This Page......

                             
                <form action="index.php" method="post">
<p align="right">
        <input style="background-color:rgb(236, 51, 51); align:right" type="submit" name="logout" value="LogOut">
</p></form>
</h2>
             
                <div class="comment-form-container">
            <form id="frm-comment">
                <div class="input-row">
                    <input type="hidden" name="comment_id" id="commentId"
                           placeholder="Name" /> <input class="input-field"
                           type="text" name="name" id="name" placeholder="Name" />
                </div>
                <div class="input-row">
                    <textarea class="input-field" type="text" name="comment"
                              id="comment" placeholder="Add a New Post..."></textarea>
                </div>
                <div>
                    <input type="button" class="btn-submit" id="submitButton"
                           value="Publish" /><div id="comment-message">Comments Added Successfully!</div>
                </div>

            </form>
        </div>
        <div id="output"></div>
        <script>
           function postReply(commentId) {
        $('#comment')[0].placeholder="Enter Your reply to the POST.....";
		$('#commentId').val(commentId);
		$("#name").focus();
	}

	$("#submitButton").click(function() {
		$("#comment-message").css('display', 'none');
		var str = $("#frm-comment").serialize();

		$.ajax({
			url : "comment-add.php",
			data : str,
			type : 'post',
			success : function(response) {
				var result = eval('(' + response + ')');
				if (response) {
					$("#comment-message").css('display', 'inline-block');
					$("#name").val("");
					$("#comment").val("");
					$("#commentId").val("");
					listComment();
				} else {
					alert("Failed to add comments !");
					return false;
				}
			}
		});
	});

	$(document).ready(function() {
		listComment();
	});

	function listComment() {
		$
				.post(
						"comment-list.php",
						function(data) {
							var data = JSON.parse(data);

							var comments = "";
							var replies = "";
							var item = "";
							var parent = -1;
							var results = new Array();

							var list = $("<ul class='outer-comment'>");
							var item = $("<li>").html(comments);

							for (var i = 0; (i < data.length); i++) {
								var commentId = data[i]['comment_id'];
								parent = data[i]['parent_comment_id'];

								if (parent == "0") {
									comments = "<div class='comment-row'>"
											+ "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>"
											+ data[i]['comment_sender_name']
											+ " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>"
											+ data[i]['date']
											+ "</span></div>"
											+ "<div class='comment-text'>"
											+ data[i]['comment']
											+ "</div>"
											+ "<div><a class='btn-reply' onClick='postReply("
											+ commentId + ")'>Reply</a></div>"
											+ "</div>";

									var item = $("<li>").html(comments);
									list.append(item);
									var reply_list = $('<ul>');
									item.append(reply_list);
									listReplies(commentId, data, reply_list);
								}
							}
							$("#output").html(list);
						});
	}

	function listReplies(commentId, data, list) {
		for (var i = 0; (i < data.length); i++) {
			if (commentId == data[i].parent_comment_id) {
				var comments = "<div class='comment-row'>"
						+ " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>"
						+ data[i]['comment_sender_name']
						+ " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>"
						+ data[i]['date'] + "</span></div>"
						+ "<div class='comment-text'>" + data[i]['comment']
						+ "</div>"
						+ "<div><a class='btn-reply' onClick='postReply("
						+ data[i]['comment_id'] + ")'>Reply</a></div>"
						+ "</div>";
				var item = $("<li>").html(comments);
				var reply_list = $('<ul>');
				list.append(item);
				item.append(reply_list);
				listReplies(data[i].comment_id, data, reply_list);
			}
		}
	}

        </script>

    <?php
       
        if(isset($_POST['logout'])){

            session_destroy();
            header['location:index.php'];
        }
    
    ?>
       </div>
    </div>

    </body> 
</html>





