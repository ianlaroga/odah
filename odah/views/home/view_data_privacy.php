<?php
require("../../controllers/connection.php");

$conn = connect();
$id = $_GET['privacyID'];
$sql = "SELECT * FROM clinic WHERE clinic_id = $id";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $clinic_id   = $row['clinic_id'];
    $clinic_name = $row['clinic_name'];
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Online Dental Appointment Hub</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/full.css" rel="stylesheet">
</head>

<body>


   <?php require('homeNav.php');?>
      

    
    <div class="container-fluid">
       <div class="card mb-4">
               <div class="card-body">
                  <div class="card-header"> 
                   <a href="appointment_book.php?bookID=<?php echo $clinic_id ?>"">Return</a> <h1>Data Privacy Policy</h1> 
                  </div>
      <div class="container">
        <div class="row">
          <p class="lead" style="justify-content:">
            We at <b> <?php echo $clinic_name ?> </b> value your privacy and is committed to protecting your personal data in accordance with Data Privacy Act of 2012. We give this notice to inform you of the ways in which we collect, use, store, share and process your personal data and the means by which you can control, to a certain extent, these processes. </p>
        </div>

        <div class="row">
          <p class="lead" style="justify-content:">
            As the personal information controller under Republic Act No. 10173 or the Data Privacy Act  of 2012, <b><?php echo $clinic_name ?></b> gives this notice to inform you of what personal information we collect and how your information will be processed and shared. </p>
        </div>

        <div class="row">
          <h6 style="font-weight: bold"> I.  PERSONAL INFORMATION WE MAY COLLECT </h6>
            <p class="lead" style="justify-content:"> The personal data we may collect from you or from your authorized representative are the following, but not limited to: </p>

          <li> A. Basic personal information such as your name, date of birth, gender at birth, nationality, and identity supporting documents including SSS ID, Driver’s License or Passport. </li>

          <li> B. Contact Details such as Residential Address, telephone or landline number, mobile phone number, and email address. </li>

          <li> C. Employment details such as your job position and affiliated company. </li>

          <li> D. Insurance details such as your insurance coverage, name of dependents and personal information of dependents. </li>

          <li> E. Payment details such as your bank, credit card number, and mode of payment. </li>

          <li> F. Health or Medical Information such as your medical history and diagnostic results.</li>

          <li> G. Social Media Profile and/or postings and information. </li> 

          <li> H. Any other personal information appearing from other commercially available sources. </li>

       </div>


      <br>
        <div class="row">
         <h6 style="font-weight: bold"> II.  MEANS TO COLLECT </h6>
            <p class="lead" style="justify-content:"> The personal information are collected by means of the following, but not limited to: </p>

          <li> A. Personally giving us your personal information and relevant health information when you avail of our dental products and services. </li>

          <li> B. Supplying us your personal data through your duly authorized representative. </li>

          <li> C. Supplying us your personal data through a third party that you gave consent to disclose.</li>

          <li> D. Supplying us information when you contact us (through Email or telephone), visit our sites or clinic branches, or view our online website and advertisements. </li>

          <li> E. Payment details such as your bank, credit card number, and mode of payment. </li>

          <li> F. Health or Medical Information such as your medical history and diagnostic results. </li>

          <li> G. Social Media Profile and/or postings and information. </li> 

          <li> H. Any other personal information appearing from other commercially available sources. </li>
       </div>

        <br>
        <div class="row">
         <h6 style="font-weight: bold"> III.  USE AND DISCLOSURE OF PERSONAL INFORMATION </h6>
            <p class="lead" style="justify-content:"> s your dental provider, we are permitted by law to make certain uses and disclosures of your personal data without your specific/written authorization. Your personal data shall be used and disclosed for the following, but not limited to; </p>

          <li> A. TREATMENT. Personal data may be shared with doctors, nurses and other healthcare providers who are involved in your treatment. </li>

          <li> B. PAYMENT. As compensation for your dental services, we may use your personal data to perform accounting, auditing, billing, reconciliation, and collection activities. Payment activities include disclosure and submission of claims to insurance companies (such as PhilHealth). </li>

          <li> C. OPERATION. We may use and disclose your personal data in conducting our dental operation. Operational activities include review of accuracy and completeness. In cancellations of transaction, personal data will be used for verification. If ownership of our organization should change, your personal data may be disclosed to the new entity.</li>

          <li> D. SUPPLIER OR BUSINESS PARTNER. In connection with treatment, payment and operation activities, we are acquiring the services of third parties performing activities for or in our behalf whom we may share and disclose your personal information. </li>

          <li> E. APPOINTMENTS, REMINDERS, HEALTHCARE SERVICES INFORMATION. We may use your contact details for the purposes of notifying your appointment and/or inform you of our services that may interest you. </li>

          <li> F. BUSINESS OPERATION. We may use your personal data for business purposes to provide the services you avail, to inform you about our products and services and to manage our sites or clinic branches and other services. We may also use your personal data for analysis, audits, crime/fraud monitoring and prevention, security, developing new products and/or services, testing, enhancing, improving or modifying our services, identifying usage trends, determining the effectiveness of our promotional campaigns, and operating and expanding our business. </li>

          <li> G. PERSONAL REPRESENTATIVE. We may disclose your personal data to your duly authorized personal representative. For example, the parent or legal guardian of a minor is considered as personal representative. </li> 

          <li> H. PUBLIC HEALTH AND SAFETY. We may disclose your personal data to public health officials to carry out public health advisories, activities, and investigations or to our government agencies for health oversight activities and investigations such as preventing or controlling infections and diseases. </li>

          <li> I. LEGAL ACTIONS or LAW ENFORCEMENT. We may disclose your personal data when required by the law and/or government authorities, such as in the course of legal proceedings such as receipt of a subpoena from the court of law. we may also disclose certain personal data as we believe is required, necessary, or appropriate under the following: (a) under applicable law, including laws outside your country of residence; (b) to comply with legal processes and/or respond to requests from competent public and government authorities including public and government authorities outside your country of residence; (c) to enforce our terms and conditions; (d) to protect our operations and those of any of our affiliates; (e) to protect our rights, privacy, security, safety, and physical and intellectual property, and/or rights of our affiliates, you, or others; and (f) to allow us to pursue available remedies or limit the damages that we may sustain. </li>

          <li> J. OTHER ACTIVITIES. To perform other activities consistent with this Notice. We do not sell your personal data to marketing companies outside of our organization. We generally process your personal data only for those purposes that we have transmitted or communicated with you. If we use it for other (closely related) purposes, additional data protection measures will be implemented, if required by law.. </li>

       </div>

       <br>
       <div class="row">
         <h6 style="font-weight: bold"> IV.  YOUR RIGHTS </h6>
            <p class="lead" style="justify-content:"> We recognize and take seriously our responsibility to protect the personal data you entrust to us from loss, misuse or unauthorized access.  The following is a summary of your rights regarding your personal data: </p>

          <li> Right to access your personal data with us </li>

          <li> Right to request restriction of access </li>

          <li> Right to limit and prevent disclosure </li>

          <li> Right to amend or update personal data </li>

          <li> Right to authorize other uses </li>

          <li> Right to receive notice of privacy breaches </li>

          <li> Right to request destruction of personal data </li> 

       </div>

         <br>
       <div class="row">
         <h6 style="font-weight: bold"> V.  MANAGE YOUR PERSONAL DATA </h6>
            <p class="lead" style="justify-content:"> If you would like to correct, update, delete, or request access to the personal information that you have provided to us, you may contact our Data Protection Officer.
            We encourage you to keep your personal settings and personal data complete and current. </p>
       </div>

       <br>
       <div class="row">
         <h6 style="font-weight: bold"> VI.  STORAGE OF PERSONAL DATA </h6>
            <p class="lead" style="justify-content:"> We have a Records Retention Policy and abide with other laws that provide higher privacy protection such as PRESIDENTIAL DECREE No. 1575: REQUIRING PRACTITIONERS OF DENTISTRY TO KEEP RECORDS OF THEIR PATIENTS. The information we collect may be stored and processed in servers in our Head Office in Makati City, Philippines and wherever our service providers have facilities around the globe and in accordance with local laws. </p>
       </div>

     <br>
       <div class="row">
         <h6 style="font-weight: bold"> VII.  RETENTION PERIOD </h6>
            <p class="lead" style="justify-content:"> We will retain your personal data for the period necessary to fulfill the purposes outlined in this Privacy Notice unless a longer retention period is required or permitted by law. We retain the personal data we collect only if we need it to support justifiable business requirements or when our lawful purposes for using the information are still relevant. When we no longer require personal data we or our third party suppliers will securely delete and/or archive the information. </p>
       </div>

       <br>
       <div class="row">
         <h6 style="font-weight: bold"> VIII.  CHANGES TO THIS PRIVACY NOTICE </h6>
            <p class="lead" style="justify-content:"> Our products and services are dynamic and the form and nature of the services may change from time to time without prior notice to you. For this reason, we reserve the right to change or add to this privacy notice from time to time and will post any material revisions on our websites.
            We will post a prominent notice on our privacy notice page to notify you of any significant changes to this privacy notice, and will indicate at the top of the notice when it was most recently updated. We encourage you to check back often to review the latest version.
            The new privacy notice will be effective upon posting. If you do not agree to the revised notice, you should alter your preferences. By continuing to access or make use of our services after the changes become effective, you agree to be bound by the revised privacy notice. </p>
       </div>

       <br>
       <div class="row">
         <h6 style="font-weight: bold"> IX.  CONTACT US </h6>
            <p class="lead" style="justify-content:"> If you have questions or concerns about our privacy practices, you can contact us by using our website www.odah.com.ph. </p>
       </div>
      </div>
    </div>
  </div>

 <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>
</html>


