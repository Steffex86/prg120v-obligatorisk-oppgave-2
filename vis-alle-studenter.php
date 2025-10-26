<?php  /* vis-alle-studenter */
/*
/*  Programmet skriver ut alle registrerte studenter
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

  $sqlSetning="SELECT * FROM student;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3> Studenter </h3>");
  print ("<table border=1>");  
  print ("<tr> <th align=center>Brukernavn</th> <th align=center>Fornavn</th> <th align=center>Etternavn</th> <th align=center>Klassekode</th> </tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
    $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
        $brukernavn=$rad["brukernavn"];
        $fornavn=$rad["fornavn"];
        $etternavn=$rad["etternavn"];
        $klassekode=$rad["klassekode"];

      print ("<tr>
                <td align=center> $brukernavn </td>
                <td align=left> $fornavn </td>
                <td align=left> $etternavn </td>
                <td align=center> $klassekode </td>
            </tr>" );
    }
  print ("</table>"); 
?>