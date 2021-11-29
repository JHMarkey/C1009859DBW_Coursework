<?php require("Header.php");
include_once("CreateUserSQL.php");
$errorfname = $errorlname = $errorpwd = $errorpcode = $errortele = $errordob = "";
$allFields = true;
$ProductID = $_GET['ProductID'];

if (isset($_POST['submit'])) {
  if ($_POST['fname'] == "") {
    $errorfname = "First name is mandatory";
    $allFields = false;
  }
  if ($_POST['lname'] == "") {
    $errorlname = "Last name is mandatory";
    $allFields = false;
  }
  if ($_POST['pwd'] == "") {
    $errorpwd = "Password is mandatory";
    $allFields = false;
  }
  if (!checkPassword()) {
    $errorpwd = "Password already in use.";
    $allFields = false;
  }
  if ($_POST['postcode'] == "") {
    $errorpcode = "Postcode is mandatory";
    $allFields = false;
  }
  if ($_POST['tele'] == "") {
    $errortele = "Telephone is mandatory";
    $allFields = false;
  }
  if ($_POST['DOB'] == null) {
    $errordob = "Date of Birth is mandatory";
    $allFields = false;
  }
  if ($allFields) {
    $createUser = createUser($ProductID);
    header('Location: userCreationSummary.php?createUser=' . $createUser);
  }
}
?>

<div class="container pb-5">
  <main role="main" class="pb-3">
    <h1 class="title"> Register Your Interest </h1>
    <p class="info">ABC BANK is organising a campaign for our new customers!
      <br>You will recieve an interest rate of 2.88% APR. aswell as a chance at winning £10,000!
    </p>
    <div class="float-container">
      <div class="row">
        <div class="col-7">
          <form method="post">

            <div class="float-child">
              <div class="form-group col-md-12">
                <label class="control-label labelFont">First Name</label>
                <input class="form-control" type="text" name="fname">
                <span class="text-danger"><?php echo $errorfname; ?></span>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label labelFont">Last Name</label>
                <input class="form-control" type="text" name="lname">
                <span class="text-danger"><?php echo $errorfname; ?></span>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label labelFont">Password</label>
                <input class="form-control" type="password" name="pwd">
                <span class="text-danger"><?php echo $errorpwd; ?></span>
              </div>
            </div>

            <div class="float-child">

              <div class="form-group col-md-12">
                <label class="control-label labelFont">Postcode</label>
                <input class="form-control" type="text" name="postcode">
                <span class="text-danger"><?php echo $errorpcode; ?></span>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label labelFont">Date of Birth</label>
                <input class="form-control" type="Date" name="DOB">
                <span class="text-danger"><?php echo $errordob; ?></span>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label labelFont">Telephone</label>
                <input class="form-control" type="Telephone" name="tele">
                <span class="text-danger"><?php echo $errortele; ?></span>
              </div>
            </div>


            <div class="form-group col-md-4">
              <input class="btn btn-primary" type="submit" value="Create User" name="submit">
            </div>
          </form>
        </div>
      </div>
  </main>
</div>


<?php require("Footer.php"); ?>