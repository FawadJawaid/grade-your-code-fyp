<?php
require('C:\wamp\www\GradeYourCode\application\views\fpdf.php');
 
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);


$pdf->Cell(40,10,"Question Marks:");
$pdf->Ln(); 
for($i=0;$i<count($result);$i++)
{
    $query = $this->db->query("select sum(points)as points from question_tc where ques_id=" . $result[$i]->question_id." group by ques_id");
    $tot = $query->first_row();
    $pdf->Cell(40,10,"Student id: ".$result[$i]->student_id." Question_id : ".$result[$i]->question_id." Marks Got: ".$result[$i]->numbers." Out of ".$tot->points);
$pdf->Ln();    
    
}
  $pdf->Ln();
    $pdf->Ln();
$pdf->Cell(40,10,"Quiz Marks:");

for($i=0;$i<count($quiz_result);$i++)
{
    $pdf->Cell(40,10,"Student id: ".$quiz_result[$i]->student_id." Marks Got: ".$quiz_result[$i]->numbers." out of ".$quiz_tot);
    
   $pdf->Ln();
    
}
$pdf->Output();
?>