<?php
session_start();
$studentEmail = $_SESSION['student_email'] ?? null;
$alumni = $_SESSION['alumni'] ?? null;
if(!isset($_SESSION['admin']) && !isset($_SESSION['alumni']) && !isset($_SESSION['student_email'])){
  header('Location:./login.php');
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Discussion Forums</title>
    <link href="assets/img/logo.png" rel="icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .question {
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            padding: 10px;
        }

        .answer-container {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 5px;
            background-color:#dbcdc4;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <form id="questionForm" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" id="questionInput" placeholder="Ask a question" name="question" <?php if (!$studentEmail) echo 'disabled'; ?>>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" <?php if (!$studentEmail) echo 'disabled'; ?>>Submit</button>
                </div>
            </div>
        </form>

        <div id="questions" class="list-group"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#questionForm').submit(function(e) {
                e.preventDefault();
                <?php if ($studentEmail !== null): ?>
                    var question = $('#questionInput').val();
                    $.ajax({
                        url: 'post_question.php',
                        type: 'POST',
                        data: {
                            question: question
                        },
                        success: function() {
                            loadQuestions();
                        }
                    });
                <?php else: ?>
                    swal("Permission Denied", "Only students can post questions!", "error");
                <?php endif; ?>
            });

            function loadQuestions() {
                $.ajax({
                    url: 'get_questions.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(questions) {
                        $('#questions').empty(); // Clear existing questions
                        questions.forEach(function(question) {
                            $('#questions').append(
                                '<a href="#" class="list-group-item list-group-item-action question" data-question-id="' + question.id + '">' +
                                question.text +
                                '<p class="small text-muted">Asked by: ' + question.student_email + ' on ' + question.timestamp + '</p>' +
                                '<div class="answerForm answerForm_' + question.id + '" style="display: none;">' +
                                '    <div class="input-group">' +
                                '        <input type="text" class="form-control" id="answerInput_' + question.id + '" placeholder="Your Answer" name="answer" <?php if (!$alumni) echo 'disabled'; ?>>' +
                                '        <div class="input-group-append">' +
                                '            <button class="btn btn-primary submitAnswer" data-question-id="' + question.id + '" <?php if (!$alumni) echo 'disabled'; ?>>Submit Answer</button>' +
                                '        </div>' +
                                '    </div>' +
                                '    <div class="answers mt-3" id="answers_' + question.id + '"></div>' +
                                '</div>' +
                                '</a>'
                            );
                        });
                    }
                });
            }

            $('#questions').on('click', '.question', function() {
                var questionId = $(this).data('question-id');
                var answerForm = $('.answerForm_' + questionId);

                if (answerForm.is(':visible')) {
                    answerForm.hide();
                } else {
                    $('.answerForm').hide();
                    answerForm.show();

                    if ($('#answers_' + questionId).html().trim().length === 0) {
                        loadAnswers(questionId);
                    }
                }
            });

            $(document).on('click', '.submitAnswer', function() {
                var questionId = $(this).data('question-id');
                var answer = $('#answerInput_' + questionId).val();
                var alumni = "<?php echo $alumni; ?>";

                $.ajax({
                    url: 'post_answer.php',
                    type: 'POST',
                    data: {
                        answer: answer,
                        questionId: questionId,
                        email: alumni
                    },
                    success: function() {
                        loadQuestions();
                    }
                });
            });

            function loadAnswers(questionId) {
                $.ajax({
                    url: 'get_answers.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        question_id: questionId
                    },
                    success: function(answers) {
                        var answersHtml = '';
                        answers.forEach(function(answer) {
                            answersHtml += '<div class="answer-container">';
                            answersHtml += '<p>Answer: ' + answer.text + '</p>';
                            answersHtml += '<p class="small text-muted">Alumni: ' + answer.email + '</p>';
                            answersHtml += '<p class="small text-muted">Posted on: ' + answer.date + '</p>';
                            answersHtml += '</div>';
                        });
                        $('#answers_' + questionId).html(answersHtml);
                    }
                });
            }

            loadQuestions();
        });
    </script>
</body>
</html>
