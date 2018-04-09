<?php
include_once("/host/home/qkrnsfjqm/html/lott/Snoopy/Snoopy.class.php");
include_once("/host/home/qkrnsfjqm/html/lott/inc/dbconn.php");
include_once("/host/home/qkrnsfjqm/html/lott/inc/head.php");

//크롤링을 위한 select 
$select_sql = "select inn from lo_num order by inn desc limit 1";

$result =  mysql_query($select_sql, $conn);

$row = mysql_fetch_assoc($result);
$count = $row["inn"]+1;
//크롤링을 위한 select 

//크롤링 시작
$lott_now=new snoopy;
$lott_before=new snoopy;
$lott_now->fetch("http://www.nlotto.co.kr/common.do?method=getLottoNumber&drwNo=");
$lott_before->fetch("http://www.nlotto.co.kr/common.do?method=getLottoNumber&drwNo=".$count);
$now=$lott_now->results;
$before=$lott_before->results;
//크롤링 끝

//data 정렬
$now_inn = json_decode($now, true);

if($now_inn["drwNo"]>=$count){
$json_before = json_decode($before, true);
$inn = $json_before["drwNo"];
$day = $json_before["drwNoDate"];
$fir = $json_before["drwtNo1"];
$sec = $json_before["drwtNo2"];
$thi = $json_before["drwtNo3"];
$fou = $json_before["drwtNo4"];
$fif = $json_before["drwtNo5"];
$six = $json_before["drwtNo6"];
$bon = $json_before["bnusNo"];
$w_mon = number_format($json_before["firstWinamnt"]);
$winner = $json_before["firstPrzwnerCo"];
//data 정렬

$ck_num = array();
$gong = array();
for($i=1;$i<=45;$i++){
	$ck_num[$i-1] = $i;
	
	if($ck_num[$i-1] == $fir){
		$gong[$i-1] = 1;
	
	}
	if($ck_num[$i-1] == $sec){
		$gong[$i-1] = 1;
	
	}
	if($ck_num[$i-1] == $thi){
		$gong[$i-1] = 1;
	
	}
	if($ck_num[$i-1] == $fou){
		$gong[$i-1] = 1;
	
	}
	if($ck_num[$i-1] == $fif){
		$gong[$i-1] = 1;
	
	}
	if($ck_num[$i-1] == $six){
		$gong[$i-1] = 1;
	
	}
	if($ck_num[$i-1] == $bon){
		$gong[$i-1] = 1;
	
	}
	if($gong[$i-1] !=1){
		$gong[$i-1] = 0;
	}	
}

//당첨번호 insert
$in_sql = "insert into lo_num(inn, dat, fir, sec, thi, fou, fif, six, bon, w_mon, winner)
		values(".$inn.", '".$day."', ".$fir.", ".$sec.", ".$thi.", ".$fou.", ".$fif.", ".$six.", ".$bon.", '".$w_mon."', '".$winner."')";

$in_result = mysql_query($in_sql, $conn);
//당첨번호 insert

//모든번호 insert
$all_in_sql = "insert into all_num(inn,g1,g2,g3,g4,g5,g6,g7,g8,g9,g10,g11,g12,g13,g14,g15,g16,g17,g18,g19,g20,g21,g22,g23,g24,g25,g26,g27,g28,g29,g30,g31,g32,g33,g34,g35,g36,g37,g38,g39,g40,g41,g42,g43,g44,g45)
		values(".$inn.", ".$gong[0].", ".$gong[1].", ".$gong[2].", ".$gong[3].", ".$gong[4].", ".$gong[5].", ".$gong[6].", ".$gong[7].", ".$gong[8].", ".$gong[9]."
			, ".$gong[10].", ".$gong[11].", ".$gong[12].", ".$gong[13].", ".$gong[14].", ".$gong[15].", ".$gong[16].", ".$gong[17].", ".$gong[18].", ".$gong[19]."
			, ".$gong[20].", ".$gong[21].", ".$gong[22].", ".$gong[23].", ".$gong[24].", ".$gong[25].", ".$gong[26].", ".$gong[27].", ".$gong[28].", ".$gong[29]."
			, ".$gong[30].", ".$gong[31].", ".$gong[32].", ".$gong[33].", ".$gong[34].", ".$gong[35].", ".$gong[36].", ".$gong[37].", ".$gong[38].", ".$gong[39]."
			, ".$gong[40].", ".$gong[41].", ".$gong[42].", ".$gong[43].", ".$gong[44].")";
			
$all_in_result = mysql_query($all_in_sql, $conn);
//모든번호 insert

//패턴분석 data 재가공 insert
$aft_result =  mysql_query($select_sql, $conn);

$aft_row = mysql_fetch_assoc($aft_result);
$aft_count = $aft_row["inn"];	
if($aft_count>=21){
$aft_insert_sql = "insert into sum_lo_num(sum_inn, sum_fir, sum_sec, sum_thi, sum_fou, sum_fif, sum_six, sum_bon)
select sum_one.inn, concat(sum_f.fir,'||',sum_one.fir,'||',sum_two.fir,'||',sum_three.fir)as fir, concat(sum_f.sec,'||',sum_one.sec,'||',sum_two.sec,'||',sum_three.sec)as sec, concat(sum_f.thi,'||',sum_one.thi,'||',sum_two.thi,'||',sum_three.thi)as thi, concat(sum_f.fou,'||',sum_one.fou,'||',sum_two.fou,'||',sum_three.fou)as fou, concat(sum_f.fif,'||',sum_one.fif,'||',sum_two.fif,'||',sum_three.fif)as fif, concat(sum_f.six,'||',sum_one.six,'||',sum_two.six,'||',sum_three.six)as six, concat(sum_f.bon,'||',sum_one.bon,'||',sum_two.bon,'||',sum_three.bon)as bon
from
(
select a.inn,				
				ifnull(sum(case when a.fir=b.fir then 1 
						when a.fir=b.sec then 1
						when a.fir=b.thi then 1
						when a.fir=b.fou then 1
						when a.fir=b.fif then 1
						when a.fir=b.six then 1
						when a.fir=b.bon then 1
					end
					),0)as fir,
				ifnull(sum(case when a.sec=b.fir then 1 
						when a.sec=b.sec then 1
						when a.sec=b.thi then 1
						when a.sec=b.fou then 1
						when a.sec=b.fif then 1
						when a.sec=b.six then 1
						when a.sec=b.bon then 1
					end
					),0)as sec,
				ifnull(sum(case when a.thi=b.fir then 1 
						when a.thi=b.sec then 1
						when a.thi=b.thi then 1
						when a.thi=b.fou then 1
						when a.thi=b.fif then 1
						when a.thi=b.six then 1
						when a.thi=b.bon then 1
					end
					),0)as thi,
				ifnull(sum(case when a.fou=b.fir then 1 
						when a.fou=b.sec then 1
						when a.fou=b.thi then 1
						when a.fou=b.fou then 1
						when a.fou=b.fif then 1
						when a.fou=b.six then 1
						when a.fou=b.bon then 1
					end
					),0)as fou,
				ifnull(sum(case when a.fif=b.fir then 1 
						when a.fif=b.sec then 1
						when a.fif=b.thi then 1
						when a.fif=b.fou then 1
						when a.fif=b.fif then 1
						when a.fif=b.six then 1
						when a.fif=b.bon then 1
					end
					),0)as fif,
				ifnull(sum(case when a.six=b.fir then 1 
						when a.six=b.sec then 1
						when a.six=b.thi then 1
						when a.six=b.fou then 1
						when a.six=b.fif then 1
						when a.six=b.six then 1
						when a.six=b.bon then 1
					end
					),0)as six,
				ifnull(sum(case when a.bon=b.fir then 1 
						when a.bon=b.sec then 1
						when a.bon=b.thi then 1
						when a.bon=b.fou then 1
						when a.bon=b.fif then 1
						when a.bon=b.six then 1
						when a.bon=b.bon then 1
					end
					),0)as bon			
		from
		(
		select *
		from lo_num
		where inn = ".$aft_count."
		)a
		inner join
		(
		select *
		from lo_num
		where inn < ".$aft_count."
		order by inn desc
		limit 5
		)b
		on a.inn != b.inn
)sum_f
inner join
(
select a.inn,				
				ifnull(sum(case when a.fir=b.fir then 1 
						when a.fir=b.sec then 1
						when a.fir=b.thi then 1
						when a.fir=b.fou then 1
						when a.fir=b.fif then 1
						when a.fir=b.six then 1
						when a.fir=b.bon then 1
					end
					),0)as fir,
				ifnull(sum(case when a.sec=b.fir then 1 
						when a.sec=b.sec then 1
						when a.sec=b.thi then 1
						when a.sec=b.fou then 1
						when a.sec=b.fif then 1
						when a.sec=b.six then 1
						when a.sec=b.bon then 1
					end
					),0)as sec,
				ifnull(sum(case when a.thi=b.fir then 1 
						when a.thi=b.sec then 1
						when a.thi=b.thi then 1
						when a.thi=b.fou then 1
						when a.thi=b.fif then 1
						when a.thi=b.six then 1
						when a.thi=b.bon then 1
					end
					),0)as thi,
				ifnull(sum(case when a.fou=b.fir then 1 
						when a.fou=b.sec then 1
						when a.fou=b.thi then 1
						when a.fou=b.fou then 1
						when a.fou=b.fif then 1
						when a.fou=b.six then 1
						when a.fou=b.bon then 1
					end
					),0)as fou,
				ifnull(sum(case when a.fif=b.fir then 1 
						when a.fif=b.sec then 1
						when a.fif=b.thi then 1
						when a.fif=b.fou then 1
						when a.fif=b.fif then 1
						when a.fif=b.six then 1
						when a.fif=b.bon then 1
					end
					),0)as fif,
				ifnull(sum(case when a.six=b.fir then 1 
						when a.six=b.sec then 1
						when a.six=b.thi then 1
						when a.six=b.fou then 1
						when a.six=b.fif then 1
						when a.six=b.six then 1
						when a.six=b.bon then 1
					end
					),0)as six,
				ifnull(sum(case when a.bon=b.fir then 1 
						when a.bon=b.sec then 1
						when a.bon=b.thi then 1
						when a.bon=b.fou then 1
						when a.bon=b.fif then 1
						when a.bon=b.six then 1
						when a.bon=b.bon then 1
					end
					),0)as bon			
		from
		(
		select *
		from lo_num
		where inn = ".$aft_count."
		)a
		inner join
		(
		select *
		from lo_num
		where inn < ".$aft_count."
		order by inn desc
		limit 10
		)b
		on a.inn != b.inn
)sum_one
on sum_f.inn = sum_one.inn
inner join
(
select a.inn,				
				ifnull(sum(case when a.fir=b.fir then 1 
						when a.fir=b.sec then 1
						when a.fir=b.thi then 1
						when a.fir=b.fou then 1
						when a.fir=b.fif then 1
						when a.fir=b.six then 1
						when a.fir=b.bon then 1
					end
					),0)as fir,
				ifnull(sum(case when a.sec=b.fir then 1 
						when a.sec=b.sec then 1
						when a.sec=b.thi then 1
						when a.sec=b.fou then 1
						when a.sec=b.fif then 1
						when a.sec=b.six then 1
						when a.sec=b.bon then 1
					end
					),0)as sec,
				ifnull(sum(case when a.thi=b.fir then 1 
						when a.thi=b.sec then 1
						when a.thi=b.thi then 1
						when a.thi=b.fou then 1
						when a.thi=b.fif then 1
						when a.thi=b.six then 1
						when a.thi=b.bon then 1
					end
					),0)as thi,
				ifnull(sum(case when a.fou=b.fir then 1 
						when a.fou=b.sec then 1
						when a.fou=b.thi then 1
						when a.fou=b.fou then 1
						when a.fou=b.fif then 1
						when a.fou=b.six then 1
						when a.fou=b.bon then 1
					end
					),0)as fou,
				ifnull(sum(case when a.fif=b.fir then 1 
						when a.fif=b.sec then 1
						when a.fif=b.thi then 1
						when a.fif=b.fou then 1
						when a.fif=b.fif then 1
						when a.fif=b.six then 1
						when a.fif=b.bon then 1
					end
					),0)as fif,
				ifnull(sum(case when a.six=b.fir then 1 
						when a.six=b.sec then 1
						when a.six=b.thi then 1
						when a.six=b.fou then 1
						when a.six=b.fif then 1
						when a.six=b.six then 1
						when a.six=b.bon then 1
					end
					),0)as six,
				ifnull(sum(case when a.bon=b.fir then 1 
						when a.bon=b.sec then 1
						when a.bon=b.thi then 1
						when a.bon=b.fou then 1
						when a.bon=b.fif then 1
						when a.bon=b.six then 1
						when a.bon=b.bon then 1
					end
					),0)as bon			
		from
		(
		select *
		from lo_num
		where inn = ".$aft_count."
		)a
		inner join
		(
		select *
		from lo_num
		where inn < ".$aft_count."
		order by inn desc
		limit 15
		)b
		on a.inn != b.inn
)sum_two
on sum_one.inn = sum_two.inn
inner join
(
select a.inn,				
				ifnull(sum(case when a.fir=b.fir then 1 
						when a.fir=b.sec then 1
						when a.fir=b.thi then 1
						when a.fir=b.fou then 1
						when a.fir=b.fif then 1
						when a.fir=b.six then 1
						when a.fir=b.bon then 1
					end
					),0)as fir,
				ifnull(sum(case when a.sec=b.fir then 1 
						when a.sec=b.sec then 1
						when a.sec=b.thi then 1
						when a.sec=b.fou then 1
						when a.sec=b.fif then 1
						when a.sec=b.six then 1
						when a.sec=b.bon then 1
					end
					),0)as sec,
				ifnull(sum(case when a.thi=b.fir then 1 
						when a.thi=b.sec then 1
						when a.thi=b.thi then 1
						when a.thi=b.fou then 1
						when a.thi=b.fif then 1
						when a.thi=b.six then 1
						when a.thi=b.bon then 1
					end
					),0)as thi,
				ifnull(sum(case when a.fou=b.fir then 1 
						when a.fou=b.sec then 1
						when a.fou=b.thi then 1
						when a.fou=b.fou then 1
						when a.fou=b.fif then 1
						when a.fou=b.six then 1
						when a.fou=b.bon then 1
					end
					),0)as fou,
				ifnull(sum(case when a.fif=b.fir then 1 
						when a.fif=b.sec then 1
						when a.fif=b.thi then 1
						when a.fif=b.fou then 1
						when a.fif=b.fif then 1
						when a.fif=b.six then 1
						when a.fif=b.bon then 1
					end
					),0)as fif,
				ifnull(sum(case when a.six=b.fir then 1 
						when a.six=b.sec then 1
						when a.six=b.thi then 1
						when a.six=b.fou then 1
						when a.six=b.fif then 1
						when a.six=b.six then 1
						when a.six=b.bon then 1
					end
					),0)as six,
				ifnull(sum(case when a.bon=b.fir then 1 
						when a.bon=b.sec then 1
						when a.bon=b.thi then 1
						when a.bon=b.fou then 1
						when a.bon=b.fif then 1
						when a.bon=b.six then 1
						when a.bon=b.bon then 1
					end
					),0)as bon			
		from
		(
		select *
		from lo_num
		where inn = ".$aft_count."
		)a
		inner join
		(
		select *
		from lo_num
		where inn < ".$aft_count."
		order by inn desc
		limit 20
		)b
		on a.inn != b.inn
)sum_three
on sum_one.inn = sum_three.inn
";

$aft_result = mysql_query($aft_insert_sql, $conn);
//패턴분석 data 재가공 insert

//five, ten, fifteen, twenty insert
$ftft_sql = "
insert into ftft_num(inn,g1,g2,g3,g4,g5,g6,g7,g8,g9,g10,
						g11,g12,g13,g14,g15,g16,g17,g18,g19,g20,
						g21,g22,g23,g24,g25,g26,g27,g28,g29,g30,
						g31,g32,g33,g34,g35,g36,g37,g38,g39,g40,
						g41,g42,g43,g44,g45)
select
   one.fInn,
   concat('1:',one.fG1, '||', two.tG1, '||', three.fiG1, '||', four.twG1) g1,
   concat('2:',one.fG2, '||', two.tG2, '||', three.fiG2, '||', four.twG2) g2,
   concat('3:',one.fG3, '||', two.tG3, '||', three.fiG3, '||', four.twG3) g3,
   concat('4:',one.fG4, '||', two.tG4, '||', three.fiG4, '||', four.twG4) g4,
   concat('5:',one.fG5, '||', two.tG5, '||', three.fiG5, '||', four.twG5) g5,
   concat('6:',one.fG6, '||', two.tG6, '||', three.fiG6, '||', four.twG6) g6,
   concat('7:',one.fG7, '||', two.tG7, '||', three.fiG7, '||', four.twG7) g7,
   concat('8:',one.fG8, '||', two.tG8, '||', three.fiG8, '||', four.twG8) g8,
   concat('9:',one.fG9, '||', two.tG9, '||', three.fiG9, '||', four.twG9) g9,
   concat('10:',one.fG10, '||', two.tG10, '||', three.fiG10, '||', four.twG10) g10,
   concat('11:',one.fG11, '||', two.tG11, '||', three.fiG11, '||', four.twG11) g11,
   concat('12:',one.fG12, '||', two.tG12, '||', three.fiG12, '||', four.twG12) g12,
   concat('13:',one.fG13, '||', two.tG13, '||', three.fiG13, '||', four.twG13) g13,
   concat('14:',one.fG14, '||', two.tG14, '||', three.fiG14, '||', four.twG14) g14,
   concat('15:',one.fG15, '||', two.tG15, '||', three.fiG15, '||', four.twG15) g15,
   concat('16:',one.fG16, '||', two.tG16, '||', three.fiG16, '||', four.twG16) g16,
   concat('17:',one.fG17, '||', two.tG17, '||', three.fiG17, '||', four.twG17) g17,
   concat('18:',one.fG18, '||', two.tG18, '||', three.fiG18, '||', four.twG18) g18,
   concat('19:',one.fG19, '||', two.tG19, '||', three.fiG19, '||', four.twG19) g19,
   concat('20:',one.fG20, '||', two.tG20, '||', three.fiG20, '||', four.twG20) g20,
   concat('21:',one.fG21, '||', two.tG21, '||', three.fiG21, '||', four.twG21) g21,
   concat('22:',one.fG22, '||', two.tG22, '||', three.fiG22, '||', four.twG22) g22,
   concat('23:',one.fG23, '||', two.tG23, '||', three.fiG23, '||', four.twG23) g23,
   concat('24:',one.fG24, '||', two.tG24, '||', three.fiG24, '||', four.twG24) g24,
   concat('25:',one.fG25, '||', two.tG25, '||', three.fiG25, '||', four.twG25) g25,
   concat('26:',one.fG26, '||', two.tG26, '||', three.fiG26, '||', four.twG26) g26,
   concat('27:',one.fG27, '||', two.tG27, '||', three.fiG27, '||', four.twG27) g27,
   concat('28:',one.fG28, '||', two.tG28, '||', three.fiG28, '||', four.twG28) g28,
   concat('29:',one.fG29, '||', two.tG29, '||', three.fiG29, '||', four.twG29) g29,
   concat('30:',one.fG30, '||', two.tG30, '||', three.fiG30, '||', four.twG30) g30,
   concat('31:',one.fG31, '||', two.tG31, '||', three.fiG31, '||', four.twG31) g31,
   concat('32:',one.fG32, '||', two.tG32, '||', three.fiG32, '||', four.twG32) g32,
   concat('33:',one.fG33, '||', two.tG33, '||', three.fiG33, '||', four.twG33) g33,
   concat('34:',one.fG34, '||', two.tG34, '||', three.fiG34, '||', four.twG34) g34,
   concat('35:',one.fG35, '||', two.tG35, '||', three.fiG35, '||', four.twG35) g35,
   concat('36:',one.fG36, '||', two.tG36, '||', three.fiG36, '||', four.twG36) g36,
   concat('37:',one.fG37, '||', two.tG37, '||', three.fiG37, '||', four.twG37) g37,
   concat('38:',one.fG38, '||', two.tG38, '||', three.fiG38, '||', four.twG38) g38,
   concat('39:',one.fG39, '||', two.tG39, '||', three.fiG39, '||', four.twG39) g39,
   concat('40:',one.fG40, '||', two.tG40, '||', three.fiG40, '||', four.twG40) g40,
   concat('41:',one.fG41, '||', two.tG41, '||', three.fiG41, '||', four.twG41) g41,
   concat('42:',one.fG42, '||', two.tG42, '||', three.fiG42, '||', four.twG42) g42,
   concat('43:',one.fG43, '||', two.tG43, '||', three.fiG43, '||', four.twG43) g43,
   concat('44:',one.fG44, '||', two.tG44, '||', three.fiG44, '||', four.twG44) g44,
   concat('45:',one.fG45, '||', two.tG45, '||', three.fiG45, '||', four.twG45) g45 
from
   (
      select
         five.* 
      from
         (
            select
               f.inn + 1 as fInn,
               sum(f.g1) as fG1,
               sum(f.g2) as fG2,
               sum(f.g3) as fG3,
               sum(f.g4) as fG4,
               sum(f.g5) as fG5,
               sum(f.g6) as fG6,
               sum(f.g7) as fG7,
               sum(f.g8) as fG8,
               sum(f.g9) as fG9,
               sum(f.g10) as fG10,
               sum(f.g11) as fG11,
               sum(f.g12) as fG12,
               sum(f.g13) as fG13,
               sum(f.g14) as fG14,
               sum(f.g15) as fG15,
               sum(f.g16) as fG16,
               sum(f.g17) as fG17,
               sum(f.g18) as fG18,
               sum(f.g19) as fG19,
               sum(f.g20) as fG20,
               sum(f.g21) as fG21,
               sum(f.g22) as fG22,
               sum(f.g23) as fG23,
               sum(f.g24) as fG24,
               sum(f.g25) as fG25,
               sum(f.g26) as fG26,
               sum(f.g27) as fG27,
               sum(f.g28) as fG28,
               sum(f.g29) as fG29,
               sum(f.g30) as fG30,
               sum(f.g31) as fG31,
               sum(f.g32) as fG32,
               sum(f.g33) as fG33,
               sum(f.g34) as fG34,
               sum(f.g35) as fG35,
               sum(f.g36) as fG36,
               sum(f.g37) as fG37,
               sum(f.g38) as fG38,
               sum(f.g39) as fG39,
               sum(f.g40) as fG40,
               sum(f.g41) as fG41,
               sum(f.g42) as fG42,
               sum(f.g43) as fG43,
               sum(f.g44) as fG44,
               sum(f.g45) as fG45 
            from
               (
                  select
                     * 
                  from
                     all_num 
                  order by
                     inn desc limit 5 
               )
               f 
         )
         five 
   )
   one 
   left join
      (
         select
            ten.* 
         from
            (
               select
                  t.inn + 1 as tInn,
                  sum(t.g1) as tG1,
                  sum(t.g2) as tG2,
                  sum(t.g3) as tG3,
                  sum(t.g4) as tG4,
                  sum(t.g5) as tG5,
                  sum(t.g6) as tG6,
                  sum(t.g7) as tG7,
                  sum(t.g8) as tG8,
                  sum(t.g9) as tG9,
                  sum(t.g10) as tG10,
                  sum(t.g11) as tG11,
                  sum(t.g12) as tG12,
                  sum(t.g13) as tG13,
                  sum(t.g14) as tG14,
                  sum(t.g15) as tG15,
                  sum(t.g16) as tG16,
                  sum(t.g17) as tG17,
                  sum(t.g18) as tG18,
                  sum(t.g19) as tG19,
                  sum(t.g20) as tG20,
                  sum(t.g21) as tG21,
                  sum(t.g22) as tG22,
                  sum(t.g23) as tG23,
                  sum(t.g24) as tG24,
                  sum(t.g25) as tG25,
                  sum(t.g26) as tG26,
                  sum(t.g27) as tG27,
                  sum(t.g28) as tG28,
                  sum(t.g29) as tG29,
                  sum(t.g30) as tG30,
                  sum(t.g31) as tG31,
                  sum(t.g32) as tG32,
                  sum(t.g33) as tG33,
                  sum(t.g34) as tG34,
                  sum(t.g35) as tG35,
                  sum(t.g36) as tG36,
                  sum(t.g37) as tG37,
                  sum(t.g38) as tG38,
                  sum(t.g39) as tG39,
                  sum(t.g40) as tG40,
                  sum(t.g41) as tG41,
                  sum(t.g42) as tG42,
                  sum(t.g43) as tG43,
                  sum(t.g44) as tG44,
                  sum(t.g45) as tG45 
               from
                  (
                     select
                        * 
                     from
                        all_num 
                     order by
                        inn desc limit 10 
                  )
                  t 
            )
            ten 
      )
      two 
      on one.fInn = two.tInn 
   left join
      (
         select
            fif.* 
         from
            (
               select
                  fi.inn + 1 as fiInn,
                  sum(fi.g1) as fiG1,
                  sum(fi.g2) as fiG2,
                  sum(fi.g3) as fiG3,
                  sum(fi.g4) as fiG4,
                  sum(fi.g5) as fiG5,
                  sum(fi.g6) as fiG6,
                  sum(fi.g7) as fiG7,
                  sum(fi.g8) as fiG8,
                  sum(fi.g9) as fiG9,
                  sum(fi.g10) as fiG10,
                  sum(fi.g11) as fiG11,
                  sum(fi.g12) as fiG12,
                  sum(fi.g13) as fiG13,
                  sum(fi.g14) as fiG14,
                  sum(fi.g15) as fiG15,
                  sum(fi.g16) as fiG16,
                  sum(fi.g17) as fiG17,
                  sum(fi.g18) as fiG18,
                  sum(fi.g19) as fiG19,
                  sum(fi.g20) as fiG20,
                  sum(fi.g21) as fiG21,
                  sum(fi.g22) as fiG22,
                  sum(fi.g23) as fiG23,
                  sum(fi.g24) as fiG24,
                  sum(fi.g25) as fiG25,
                  sum(fi.g26) as fiG26,
                  sum(fi.g27) as fiG27,
                  sum(fi.g28) as fiG28,
                  sum(fi.g29) as fiG29,
                  sum(fi.g30) as fiG30,
                  sum(fi.g31) as fiG31,
                  sum(fi.g32) as fiG32,
                  sum(fi.g33) as fiG33,
                  sum(fi.g34) as fiG34,
                  sum(fi.g35) as fiG35,
                  sum(fi.g36) as fiG36,
                  sum(fi.g37) as fiG37,
                  sum(fi.g38) as fiG38,
                  sum(fi.g39) as fiG39,
                  sum(fi.g40) as fiG40,
                  sum(fi.g41) as fiG41,
                  sum(fi.g42) as fiG42,
                  sum(fi.g43) as fiG43,
                  sum(fi.g44) as fiG44,
                  sum(fi.g45) as fiG45 
               from
                  (
                     select
                        * 
                     from
                        all_num 
                     order by
                        inn desc limit 15 
                  )
                  fi 
            )
            fif 
      )
      three 
      on one.fInn = three.fiInn 
   left join
      (
         select
            twen.* 
         from
            (
               select
                  tw.inn + 1 as twInn,
                  sum(tw.g1) as twG1,
                  sum(tw.g2) as twG2,
                  sum(tw.g3) as twG3,
                  sum(tw.g4) as twG4,
                  sum(tw.g5) as twG5,
                  sum(tw.g6) as twG6,
                  sum(tw.g7) as twG7,
                  sum(tw.g8) as twG8,
                  sum(tw.g9) as twG9,
                  sum(tw.g10) as twG10,
                  sum(tw.g11) as twG11,
                  sum(tw.g12) as twG12,
                  sum(tw.g13) as twG13,
                  sum(tw.g14) as twG14,
                  sum(tw.g15) as twG15,
                  sum(tw.g16) as twG16,
                  sum(tw.g17) as twG17,
                  sum(tw.g18) as twG18,
                  sum(tw.g19) as twG19,
                  sum(tw.g20) as twG20,
                  sum(tw.g21) as twG21,
                  sum(tw.g22) as twG22,
                  sum(tw.g23) as twG23,
                  sum(tw.g24) as twG24,
                  sum(tw.g25) as twG25,
                  sum(tw.g26) as twG26,
                  sum(tw.g27) as twG27,
                  sum(tw.g28) as twG28,
                  sum(tw.g29) as twG29,
                  sum(tw.g30) as twG30,
                  sum(tw.g31) as twG31,
                  sum(tw.g32) as twG32,
                  sum(tw.g33) as twG33,
                  sum(tw.g34) as twG34,
                  sum(tw.g35) as twG35,
                  sum(tw.g36) as twG36,
                  sum(tw.g37) as twG37,
                  sum(tw.g38) as twG38,
                  sum(tw.g39) as twG39,
                  sum(tw.g40) as twG40,
                  sum(tw.g41) as twG41,
                  sum(tw.g42) as twG42,
                  sum(tw.g43) as twG43,
                  sum(tw.g44) as twG44,
                  sum(tw.g45) as twG45 
               from
                  (
                     select
                        * 
                     from
                        all_num 
                     order by
                        inn desc limit 20 
                  )
                  tw 
            )
            twen 
      )
      four 
      on one.fInn = four.twInn
";
$ftft_num_result = mysql_query($ftft_sql, $conn);
//five, ten, fifteen, twenty insert
}
}

?>

<body>
<h1 class="text-center"><b>10회 당첨번호</b></h1>
<table class="table table-bordered text-center">
	<tr>
		<th class="text-center">회차</th>
		<th class="text-center">추첨일</th>
		<th class="text-center">1공</th>
		<th class="text-center">2공</th>
		<th class="text-center">3공</th>
		<th class="text-center">4공</th>
		<th class="text-center">5공</th>
		<th class="text-center">6공</th>
		<th class="text-center">보너스</th>
		<th class="text-center">당첨금</th>
		<th class="text-center">승리자</th>
	</tr>
<?php
$all_select_sql = "select * from lo_num order by inn desc limit 10";
$se_result = mysql_query($all_select_sql, $conn);
while($row=mysql_fetch_assoc($se_result)){
?>
	<tr id="<?=$row["inn"]?>">
		<td><?=$row["inn"]?></td>
		<td><?=$row["dat"]?></td>
		<td><?=$row["fir"]?></td>
		<td><?=$row["sec"]?></td>
		<td><?=$row["thi"]?></td>
		<td><?=$row["fou"]?></td>
		<td><?=$row["fif"]?></td>
		<td><?=$row["six"]?></td>
		<td><?=$row["bon"]?></td>
		<td><?=$row["w_mon"]?></td>
		<td><?=$row["winner"]?></td>
	</tr>
	<script>
		$("#<?=$row["inn"]?>").click(function(){
		if($("#<?=$row["inn"]?>_").length==0){		
		$.ajax({
		type:"POST",
		url:"./tenWeek.php",
		data:{id:"<?=$row["inn"]?>"},
		datatype:"JSON",
		success:function(data){
				if (data != '') {
					console.log(data);				
					var jsonObj = JSON.parse(data);

					var real_tr = document.getElementById(jsonObj.inn);						
					var tr = document.createElement('tr');
					var td1 = document.createElement('td');
					var td_em = document.createElement('td');
					var td2 = document.createElement('td');
					var td3 = document.createElement('td');
					var td4 = document.createElement('td');
					var td5 = document.createElement('td');
					var td6 = document.createElement('td');
					var td7 = document.createElement('td');
					var td8 = document.createElement('td');

					real_tr.after(tr);
					tr.id = jsonObj.inn+"_";

					tr.appendChild(td1);
					tr.appendChild(td_em);
					tr.appendChild(td2);
					tr.appendChild(td3);
					tr.appendChild(td4);
					tr.appendChild(td5);
					tr.appendChild(td6);
					tr.appendChild(td7);
					tr.appendChild(td8);

					td1.innerHTML = jsonObj.inn;
					td_em.innerHTML = jsonObj.inn+"를"+(parseInt(jsonObj.inn)-1)+" ~ "+(parseInt(jsonObj.inn)-20)+"에서 카운팅";						
					td2.innerHTML = jsonObj.fir;						
					td3.innerHTML = jsonObj.sec;						
					td4.innerHTML = jsonObj.thi;						
					td5.innerHTML = jsonObj.fou;						
					td6.innerHTML = jsonObj.fif;						
					td7.innerHTML = jsonObj.six;						
					td8.innerHTML = jsonObj.bon;

					tr.style = "color:red";

					$("#"+jsonObj.inn+"_").click(function(){
					tr.remove();
					});					
				}
			},
			error:function(e){
			alert("서버 통신에 문제가 있습니다.");
			}
		});
		}else{
			$("#<?=$row["inn"]?>_").remove();
		}
	});
	</script>
<?php	
}
?>	
</table>
<?php
include_once("/host/home/qkrnsfjqm/html/lott/inc/footer.php");
?>