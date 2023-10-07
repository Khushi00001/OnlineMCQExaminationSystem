<?php
require_once('tcpdf/tcpdf.php');

// Check if the required data is present
if (
    isset($_GET['totalQuestions']) &&
    isset($_GET['correctAnswers']) &&
    isset($_GET['incorrectAnswers']) &&
    isset($_GET['marks']) &&
    isset($_GET['incorrectQuestions'])
) {
    // Retrieve the test results data from the $_GET array
    $totalQuestions = $_GET['totalQuestions'];
    $correctAnswers = $_GET['correctAnswers'];
    $incorrectAnswers = $_GET['incorrectAnswers'];
    $marks = $_GET['marks'];
    $incorrectQuestions = json_decode($_GET['incorrectQuestions'], true);

    // Create a new TCPDF instance
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Test Results');
    $pdf->SetSubject('Test Results');
    $pdf->SetKeywords('Test, Results');

    // Set default header and footer data
    $pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
    $pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));

    // Set header and footer fonts
    $pdf->setHeaderFont(Array('helvetica', '', 10));
    $pdf->setFooterFont(Array('helvetica', '', 8));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(15, 15, 15, true);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, 15);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Set content for test results
    $content = '
        <style>
            h3 {
                color: crimson;
                font-size: 18px;
                margin-bottom: 10px;
            }

            p {
                color: #333;
                font-size: 14px;
                margin: 0;
            }

            .question {
                margin-top: 15px;
            }

            .question p {
                margin-bottom: 5px;
            }

            .question hr {
                border-color: #ccc;
            }
        </style>
        <h3>Test Results</h3>
        <p>Total Questions: '.$totalQuestions.'</p>
        <p>Correct Answers: '.$correctAnswers.'</p>
        <p>Incorrect Answers: '.$incorrectAnswers.'</p>
        <p>Marks Obtained: '.$marks.'</p>
        ';

    // Add incorrect questions and answers
    if (!empty($incorrectQuestions) && is_array($incorrectQuestions)) {
        $content .= '<h3>Incorrect Questions</h3>';
        foreach ($incorrectQuestions as $question) {
            $questionText = $question['question'];
            $correctAnswer = $question['correctAnswer'];
            $userAnswer = $question['userAnswer'];

            $content .= '
                <div class="question">
                    <p><strong>Question:</strong> '.$questionText.'</p>
                    <p><strong>Correct Answer:</strong> '.$correctAnswer.'</p>
                    <p><strong>Your Answer:</strong> '.$userAnswer.'</p>
                    <hr>
                </div>
            ';
        }
    }

    // Write the content to the PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Output the PDF as a download
    $pdf->Output('test_results.pdf', 'D');
} else {
    echo 'Test results data is missing. Please provide the necessary data.';
}
?>
