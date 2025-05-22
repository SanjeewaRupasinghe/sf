<?php
function draw_calendar($month,$year)
{

$date = mktime( 0, 0, 0, $month, 1, $year );
$ndate=strftime( '%m %Y', strtotime( '+1 month', $date ) ); list($nm,$ny)=explode(" ",$ndate); 
$pdate=strftime( '%m %Y', strtotime( '-1 month', $date ) ); list($pm,$py)=explode(" ",$pdate);
$dt=date('d');$dm=date('m');
$cl="";
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="table mb-0" >';
	$calendar.= '<tr class="calendar-head"><td class="col-1"><a href="calendar.php?month='.$pm.'&year='.$py.'" class="prvnxt"><i class="fa fa-angle-left"></i></a> </td><td class="col-10" colspan="5"><h2 style=" text-align:center">'.strftime('%B',strtotime('0 month',$date)).' '.$year.'</h2></td><td class="col-3"><a href="calendar.php?month='.$nm.'&year='.$ny.'"  class="prvnxt"><i class="fa fa-angle-right" style="text-align:right"></i></a></td></tr></table>';	
	$calendar.= '<table cellpadding="0" cellspacing="0" class="table">';
	/* table headings */
	$headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $cdate=$year.'-'.$month.'-'.$list_day;
        //$link='book_details.php?day='.$cdate;


		$calendar.= '<td class="calendar-day"><a href="#" class="novalue">';
			/* add in the day number */
		if($list_day==$dt && $month==$dm) { $cl="act_day";} else { $cl="";} 
			$calendar.= '<div class="day-number '.$cl.'">'.$list_day.'</div>';
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			
			$calendar.= '<p style="">2 Courses</p>';
			
		$calendar.= '</a></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
?>