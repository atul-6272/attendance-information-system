<?php
	require("fpdf/fpdf.php");
	$db = new PDO("mysql:host=localhost;dbname=ais","root","");
	class myPDF extends FPDF{
		function header(){
			$this->SetFont("Arial","",8);
			$tDate = date("F j, Y");
			$this->Cell(0, 10, "Date : ".$tDate, 0, 0, "R");
			$this->Ln(2);
			
			$this->SetFont("Arial","B",24);
			$this->Cell(276,5,"ATTENDANCE INFORMATION SYSTEM",0,0,"C");
			$this->Ln(10);
			$this->SetFont("Times","",12);
			$this->Cell(276,5,'EMPLOYEE REPORT',0,0,'C');
			$this->Ln(20);
			
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont("Arial","",8);
			$this->Cell(0,10,"Page".$this->PageNo()."/{nb}",0,0,"C");
			
			
		}
		function headerTable(){
			$this->SetFont("Times","B",12);
			$this->Cell(10,10,"S.No",1,0,"C");
			$this->Cell(20,10,"EMPID",1,0,"C");
			$this->Cell(40,10,"Name",1,0,"C");
			$this->Cell(53,10,"Department",1,0,"C");
			$this->Cell(30,10,"Date of Joining",1,0,"C");
			$this->Cell(40,10,"Reporting Officer",1,0,"C");
			$this->Cell(55,10,"Project",1,0,"C");
			$this->Cell(25,10,"Date of Exit",1,0,"C");
			$this->Ln();
			
		}
		function viewTable($db){
			$cnt=1;
			$this->SetFont("Times","",10);
			$stmt = $db->query("select * from tbl_employees");
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(10,10,$cnt++,1,0,"C");
				$this->Cell(20,10,$data->EmpId,1,0,"C");
				$this->Cell(40,10,$data->FirstName.''.$data->LastName,1,0,"L");
				$this->Cell(53,10,$data->Department,1,0,"L");
				$this->Cell(30,10,$data->DOJ,1,0,"C");
				$this->Cell(40,10,$data->Reportingofficer,1,0,"L");
				$this->Cell(55,10,$data->Project,1,0,"L");
				$this->Cell(25,10,$data->DOE,1,0,"C");
				$this->Ln();
			}
			
			
		}
		
	}
	
	
	$pdf=new myPDF();
	$pdf->AliasNbPages();
	
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	
	$pdf->Output();
?>