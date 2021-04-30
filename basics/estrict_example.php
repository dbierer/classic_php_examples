<?php
error_reporting(-1);
/////////////////////////////////////////////////////////////
//InstaCalendar
//                                   Marcos Ojeda 2002.Jul.11
//                                      Last Updated 20020528
//       more comments, cleaner code, uses more date functions
// Fill in default,today values accordingly as well as font..
// NB: $month can be changed, but not $textmonth
// "Remember who loves you, baby!" --Kojack
/////////////////////////////////////////////////////////////
  $fontfamily = isset($fontfamily) ? $fontfamily : "Tahoma, Geneva, sans-serif";
  $defaultfontcolor = isset($defaultfontcolor) ? $defaultfontcolor : "#000000";
  $defaultbgcolor = isset($defaultbgcolor) ? $defaultbgcolor : "#FFFFFF";
  $todayfontcolor = isset($todayfontcolor) ? $todayfontcolor : "#FFFFFF";
  $todaybgcolor = isset($todaybgcolor) ? $todaybgcolor : "#CC0000";
  $monthcolor = isset($monthcolor) ? $monthcolor : "#333399";
  $relfontsize = isset($relfontsize) ? $relfontsize : "1";
  $cssfontsize = isset($cssfontsize) ? $cssfontsize : "7pt";

  $month = (isset($month)) ? $month : date("n",time());
  $textmonth = date("F",mktime(1,1,1,$month,1,$year));
  //if date("F",mktime(1,1,1,$month,1,$year)) doesn't work, then use this old implementation
  //$monthnames = array("January","February","March","April","May","June","July","August","September","October","November","December");
  //$textmonth = $monthnames[$month - 1];

  $year = (isset($year)) ? $year : date("Y",time());
  $today = (isset($today))? $today : date("j", time());  // Make $today really big to avoid hilighting
  $today = ($month == date("n",time()) && $year == date("Y",time())) ? $today : 32;  //will only highlight today for this month & year

  //this method of finding dates is old, but if date("t",mktime(1,1,1,$month,1,$year); doesn't work then use this
//  if ( (($month < 8) && ($month % 2 == 1)) || (($month > 7) && ($month % 2 == 0)) )
//    $days = 31;
//  if ( (($month < 8) && ($month % 2 == 0)) || (($month > 7) && ($month % 2 == 1)) )
//    $days = 30;
//  if ($month == 2)
//    $days = (date("L",time())) ? 29 : 28;
  $days = date("t",mktime(1,1,1,$month,1,$year));

  $dayone = date("w",mktime(1,1,1,$month,1,$year));
  $daylast = date("w",mktime(1,1,1,$month,$days,$year));
  $dayarray = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td bgcolor="<?php echo $defaultbgcolor ?>" colspan="7" valign="middle" align="center"><font color="<?php echo $monthcolor ?>" face="Arial, Helvetica, sans-serif" size="3"><b><?php echo $textmonth ?></b></font></td>
 </tr>
 <tr>
<?php  //printing the days of week
    for($i=0; $i <= 6; $i++):
      $width = ($i == 0 || $i == 6) ? "15%" : "14%";
      //use the css (default) or the html version (commented out) underneath if you want full compatibility
    echo '  <td valign="middle" width=$width" style="text-align:center; background:{$defaultbgcolor}; font:bold {$cssfontsize} {$fontfamily}; color:{$defaultfontcolor};">$dayarray[$i]</td>';
    //echo "  <td bgcolor="$defaultbgcolor" valign="middle" align="center" width="$width"><font color="$fontcolor" face="$fontfamily" size="$relfontsize">$i</font></td>n";
  endfor;
  echo "</tr>\n";  //done printing the top row of days

  $span1 = $dayone;
  $span2 = 6 - $daylast;

  for($i = 1; $i <= $days; $i++):
    $dayofweek = date("w",mktime(1,1,1,$month,$i,$year));
    $width = ($dayofweek == 0 || $dayofweek == 6) ? "15%" : "14%"; //sets the col width

    switch ($i):
      case $today: //sets background color for today
        $fontcolor = $todayfontcolor;
        $bgcellcolor = $todaybgcolor;
      break;
        default: //sets background color for other days
        $fontcolor = $defaultfontcolor;
        $bgcellcolor = $defaultbgcolor;
      break;
    endswitch;

//    if($i == putdayhere):  #use this for *special* days of the month, can be set ahead as well w/ &&...
//      $fontcolor = puthexcolorhere;
//      $bgcellcolor = puthexcolorhere;
//    endif;

    if($i == 1 || $dayofweek == 0):
      echo " <tr bgcolor='$defaultbgcolor'>\n";
      if($span1 > 0 && $i == 1)
        echo '  <td align="left" bgcolor="$defaultbgcolor" colspan="$span1"><font face="null" size="1">&nbsp;</font></td>';
    endif;
    
      //use the css (default) or the html version (commented out) underneath if you want full compatibility
    echo '  <td valign="middle" width=$width" style="text-align:center; background:{$bgcellcolor}; font-family:{$fontfamily}; color:{$fontcolor}; font-size:{$cssfontsize}">$i</td>';
    //echo "  <td bgcolor="$bgcellcolor" valign="middle" align="center" width="$width"><font color="$fontcolor" face="$fontfamily" size="$relfontsize">$i</font></td>n";

    if($i == $days && $span2 > 0)
      echo ' <td align="left" bgcolor="$defaultbgcolor" colspan="$span2"><font face="null" size="1">&nbsp;</font></td>';
    if($dayofweek == 6 || $i == $days)
      echo " </tr>n";
  endfor;
  echo "</table>n";
?>
