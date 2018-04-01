
<?php
class Calendar {

  /**
   * Constructor
   */
  public function __construct(){
      $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
  }

  /********************* PROPERTY ********************/
  private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");

  private $currentYear=0;

  private $currentMonth=0;

  private $currentDay=0;

  private $currentDate=null;

  private $daysInMonth=0;

  private $naviHref= null;

  /********************* PUBLIC **********************/

  /**
  * print out the calendar
  */
  public function show() {
      $year  == null;

      $month == null;

      $day == null;

      if(null==$year&&isset($_GET['year'])){

          $year = $_GET['year'];

      }else if(null==$year){

          $year = date("Y",time());

      }

      if(null==$month&&isset($_GET['month'])){

          $month = $_GET['month'];

      }else if(null==$month){

          $month = date("m",time());

      }

      if(null==$day&&isset($_GET['day'])){

          $day = $_GET['day'];

      }else if(null==$day){

          $day = date("d",time());

      }

      $this->currentYear=$year;

      $this->currentMonth=$month;

      $this->currentDay=$day;

      $this->daysInMonth=$this->_daysInMonth($month,$year);

      $content='<div id="calendar">'.
                      '<div class="box">'.
                      $this->_createNavi().
                      '</div>'.
                      '<div>'.
                      '<table id="hoursTable">';

                      /*for ($h=0; $h < 24; $h++) {
                        $content.=$this->_showHours($h);
                      }*/

                      $content.='</table>'.
                      '<table id="planningTable">'.
                              '<tr id="planning_labels">'.$this->_createLabels().'</tr>';
                              //$content.='<div class="clear"></div>';
                              // $content.='<ul class="dates">';
                              //$content.='<table class="dates">';

                              for ($r=0; $r < 24 ; $r++) {
                                $content.=$this->_showReservations($r);
                              }

                              //$weeksInMonth = $this->_weeksInMonth($month,$year);
                              // Create weeks in a month
                              //for( $i=0; $i<$weeksInMonth; $i++ ){

                                  //Create days in a week
                                  //for($j=1;$j<=7;$j++){
                                      //$content.=$this->_showDay($j);
                                      //for ($h=0; $h <= 23; $h++) {
                                      //    $content.=$this->_showHours($h);
                                      //}
                                  //}
                              //}
                              $content.='</table>';
                              // $content.='</ul>';

                              $content.='<div class="clear"></div>';

                      $content.='</div>';

      $content.='</div>';
      return $content;
  }

  /********************* PRIVATE **********************/
  /**
  * create the li element for ul
  */
  private function _showDay($cellNumber){

      if($this->currentDay==0){

          $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

          if(intval($cellNumber) == intval($firstDayOfTheWeek)){

              $this->currentDay=1;

          }
      }

      if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){

          $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));

          $cellContent = $this->currentDay;

          $this->currentDay++;

      }else{

          $this->currentDate =null;

          $cellContent=null;
      }


      return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
              ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
  }

    private function _showHours($i){

        $cellContent=$i;

        return '<tr><td>'.$cellContent.'</td></tr>';


    }

    private function _showReservations($i){

      $cellContent=$i;

      return '<tr><td>'.$cellContent.':00'.'</td></tr>';

    }

  /**
  * create navigation
  */
  private function _createNavi(){

      $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

      $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

      $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

      $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

      return
          '<div class="header">'.
              '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                  '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
              '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
          '</div>';
  }

  /**
  * create calendar week labels
  */
  private function _createLabels(){

      $content='';

      $dayMonday = null;

      $currentDayWeek = date('D', time());

      //$this->daysInMonth

      switch ($currentDayWeek) {
        case 'Mon':
          $dayMonday = date('d', time());
        break;

        case 'Tue':
          $dayMonday = date('d', time())-1;
        break;

        case 'Wed':
          $dayMonday = date('d', time())-2;
        break;

        case 'Thu':
          $dayMonday = date('d', time())-3;
        break;

        case 'Fri':
          $dayMonday = date('d', time())-4;
        break;

        case 'Sat':
          $dayMonday = date('d', time())-5;
        break;

        case 'Sun':
          $dayMonday = date('d', time())-6;
        break;

        default:
          break;
      }

      //if the monday is for the previous month

      if ($dayMonday<=0) {

        $currentMonth = $currentMonth-1;

        if ($currentMonth<=0) {

          $currentYear = $currentYear-1;

          $currentMonth = 12;

        }

        $dayInPrevMonth = $this->_daysInMonth($currentMonth, $currentYear);


      }

      // if the monday is for the next month
      if ($dayMonday>$daysInMonth) {

        $currentMonth = $currentMonth+1;

        if ($currentMonth>12) {

          $currentMonth = 1;

          $currentYear = $currentYear+1;

        }

        $excesDays = $this->daysInMonth - $dayMonday;

        $dayMondayNext = $excesDays;
      }

      //foreach($this->dayLabels as $index=>$label){
      for ($i=0; $i < 7; $i++) {
        $label = ($dayMonday+$i) % $this->daysInMonth;

        if ($label == 0) {
          $label = $this->daysInMonth;
        }

        $labelDay2 = date('D', strtotime($this->currentYear.'-'.$this->currentMonth.'-'.$label));

        $labelDay2.=' '.$label;

        $content.='<th>'.$labelDay2.'</th>';
      }


      return $content;
  }



  /**
  * calculate number of weeks in a particular month
  */
  private function _weeksInMonth($month=null,$year=null){

      if( null==($year) ) {
          $year =  date("Y",time());
      }

      if(null==($month)) {
          $month = date("m",time());
      }

      // find number of days in this month
      $daysInMonths = $this->_daysInMonth($month,$year);

      $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

      $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

      $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

      if($monthEndingDay<$monthStartDay){

          $numOfweeks++;

      }

      return $numOfweeks;
  }

  /**
  * calculate number of days in a particular month
  */
  private function _daysInMonth($month=null,$year=null){

      if(null==($year))
          $year =  date("Y",time());

      if(null==($month))
          $month = date("m",time());

      return date('t',strtotime($year.'-'.$month.'-01'));
  }

}
