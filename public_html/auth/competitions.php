<?php
  /*
  echo "startDate: " . $_POST['startDate'] . "\n";
  echo "endDate: " . $_POST['endDate'] . "\n";
  echo "startTime: " . $_POST['startTime'] . "\n"; 
  echo "endTime: " . $_POST['endTime'] . "\n"; 
  $start = $_POST['startDate'] . " " . $_POST['startTime'];
  $end = $_POST['endDate'] . " " . $_POST['endTime'];
  echo "start " . $start . "\n";
  echo "end " . $end . "\n";
  echo "buyin: " . $_POST['buyin'] . "\n";
  echo "portfolio: " . $_POST['creator'] . "\n";
  echo "competition: " . htmlspecialchars($_POST['compName']) . "\n";
  */ 
  // functions that facilitate competitions
  include '/home/ssts/simulatedstocktradingsystem/competitions/'
    . 'CompetitionEngine.php';
  include_once '/home/ssts/simulatedstocktradingsystem/portfolios/'
    . 'PortfolioEngine.php';
  include_once '/home/ssts/simulatedstocktradingsystem/transactions/'
    . 'TransactionEngine.php';
  
  
  $uid = $_SESSION['id'];
  $portfolio = $_POST['portfolio'];
  if($portfolio != '') {
    setActivePortfolio($uid, $portfolio);
  } else {
    $portfolio = getActivePortfolio($uid, $portfolio);
    $_SESSION['active_portfolio'] = $portfolio;
  }

  // let's make a competition
  // first, sanitize input
  $compName=trim(htmlspecialchars($_POST['compName']));
  $buyin=trim(htmlspecialchars($_POST['buyin']));
  $startDate=$_POST['startDate'];
  $endDate=$_POST['endDate'];
  if ($compName!='' && $startDate!='' && $endDate!='' 
    && ctype_digit($buyin) && $buyin > 0) {
      $start = $startDate . " " . $_POST['startTime'];
      $end = $endDate . " " . $_POST['endTime'];
      $status = createComp($uid, $portfolio, $compName, $start,
        $end, $buyin);
      //echo "Competition : " . $status;
  }
 
  //join a competition
  if($_POST['joinComp']!='') {
    $status = addUser($_POST['joinComp'], $uid, $portfolio);
    //echo $status;
  }
  // leave a competition
  if($_POST['leaveComp']!='') {
    $status=leaveComp($_POST['leaveComp'], $uid);
  }
  // get competition portfolio
  if(isCompeting($uid, $portfolio))
    $compPortfolio = getCompPortfolio($uid, $portfolio);

  //buy stock
  $numSharesBuy=$_POST['numSharesBuy'];
  if(ctype_digit($numSharesBuy) && $numSharesBuy>0)
    $status=buyStock($uid, $compPortfolio, 
      $_POST['buyStock'], $numSharesBuy); 
  
  // sell a stock 
  if(ctype_digit($_POST['numSharesSell']) && $_POST['numSharesSell']>0) {
    $status=sellStock($uid, $compPortfolio, 
      $_POST['sellMe'], $_POST['numSharesSell']); 
  }

  if(isset($status) && ($status!=true || $status<=0))
    echo "<p style=\"color: red\"> ERROR </p>";
?>

<h1>Competitions: <?php echo $portfolio; ?></h1>
<div class="comp-activeform">
<form method="POST" action="index.php?competitions" class="form-inline" role="form">
   <div class="form-group">
   <select name="portfolio" class="form-control">
    <?php
      echo "<option selected=\"selected\">";
      echo $portfolio . "</option>";
      $portfolios = getInactiveUserPortfolios($uid);
      foreach($portfolios as $port) {
        echo "<option value=\"" . $port[0] . "\">";
	echo $port[0];
	echo "</option>\n";
      }
    ?>
   </select>
   </div>
   <input type="submit" value="Select Active Portfolio" class="btn btn-default" />
</form>
</div>

<?php
  $cid = isCompeting($uid, $portfolio);
  if($portfolio != '' ) {
    if($cid == false) {
      include 'available_competitions.php';
    } else {
      include 'your_competitions.php';
    }
  }
  
?>



<?php include 'competitions_modals.php'; ?>

<script type="text/javascript">
  $(function() {
    $( ".datepicker" ).datepicker({
      dateFormat: "yy-mm-dd", minDate: "+1D"
    });
  });
</script>
<?php  
  // display buy stock modal as  needed 
  if($_POST['selectStock']!='') {
    
    echo "<script type=\"text/javascript\">";
    echo "$('#stockBuyModal').modal('show');";
    echo "</script>";
 
  }
?>  
<?php  
  // display sell stock modal as  needed 
  if($_POST['sellStock']!='') {
    
    echo "<script type=\"text/javascript\">";
    echo "$('#stockSellModal').modal('show');";
    echo "</script>";
 
  }
?>  
