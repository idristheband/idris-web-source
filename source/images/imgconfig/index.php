<?php

/******************************************************

  FhImage

  Copyright (c) 2003 Flash-here.com (support@flash-here.com)

*******************************************************/

?>

<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<title>FhImage Config Settings</title>
<script language="JavaScript">
<!--
	var cur_box = "g_bgcolor";
	
	function box_clicked(b)
	{
		cur_box = b;

		prefix = "<font color=\"#336699\" size=\"-1\">";
		suffix = "</font>";
		label_div = document.getElementById("colorbox_label");
		if(cur_box == "g_gbcolor") {
			label_div.innerHTML = prefix + "set background color:" + suffix;
		} else if(cur_box == "g_desccolor") {
			label_div.innerHTML = prefix + "set description color:" + suffix;
		} else if(cur_box == "g_titlecolor") {
			label_div.innerHTML = prefix + "set title color:" + suffix;
		} else if(cur_box == "g_textcolor") {
			label_div.innerHTML = prefix + "set other text color:" + suffix;
		} else if(cur_box == "g_linkcolor") {
			label_div.innerHTML = prefix + "set link color:" + suffix;
		} else if(cur_box == "g_vlinkcolor") {
			label_div.innerHTML = prefix + "set visited link color:" + suffix;
		}
		
	}

	function color_selected(c)
	{
		document.getElementById(cur_box).value = "#" + c;
	}
	
//-->
</script>
<!-- close color picker jscript -->
</head>
<body bgcolor=white>

<div style="font-family:arial, helvetica, sans-serif; color:black; font-size:14pt; font-weight:bold;">FhImage 
  Config Settings</div>

<?php

switch($mode)
{
  case 'write':

  if ($fp = fopen("../settings.php", 'w')) {
    $data="<"."?php
// title
\$g_title='$g_title';
// description 
\$g_desc='$g_desc';
// number of columns per page
\$g_cols='$g_cols';
// number of rows per page
\$g_rows='$g_rows';
// whether thumb width or height is specified
\$g_thumb_worh='$g_thumb_worh';
// thumbnail width/height
\$g_twidth='$g_twidth';
// spacing between thumbs
\$g_spacing='$g_spacing';
// background color
\$g_bgcolor='$g_bgcolor';
// title text color
\$g_titlecolor='$g_titlecolor';
// description text color
\$g_desccolor='$g_desccolor';
// other text color
\$g_textcolor='$g_textcolor';
// link color
\$g_linkcolor='$g_linkcolor';
// vlink color
\$g_vlinkcolor='$g_vlinkcolor';
// display file name?
\$g_dispFn='$g_dispFn';
// sort by filename
\$g_sortByFn='$g_sortByFn';
// case insensitive sort
\$g_insensitive_sort='$g_insensitive_sort';
// what to be used as folder image
\$g_folderImg='$g_folderImg';
// show full sized image in pop up window?
\$g_showInPopup='$g_showInPopup';
// pop up window default width
\$g_popupWidth='$g_popupWidth';
// pop up window default height
\$g_popupHeight='$g_popupHeight';
// shrink popup window size if image is smaller than default size
\$g_shrinkPopup='$g_shrinkPopup';
global \$g_title, \$g_desc, \$g_cols, \$g_rows, \$g_thumb_worth,
 \$g_twidth, \$g_spacing, \$g_bgcolor, \$g_titlecolor, \$g_desccolor, 
 \$g_textcolor, \$g_linkcolor, \$g_vlinkcolor, \$g_dispFn,
 \$g_sortByFn, \$g_insensitive_sort, 
 \$g_folderImg, \$g_showInPopup, \$g_popupWidth, \$g_popupHeight,
 \$g_shrinkPopup;
?".">";

    fwrite ($fp, $data);
//    chmod("../settings.php", 0777);

  }

  echo "<div style=\"font-family:arial, helvetica, sans-serif; color:red; font-size:10pt; font-weight:bold;\">";
  echo "Settings Saved.....</div><p>";
  break;
}
	
?>

<?php
if (file_exists("../settings.php"))
{
	include("../settings.php");
}
?>

<form name="settingForm" action="<? echo "$PHP_SELF?mode=write";?>" method="post">

  <table border="0" cellspacing="10" cellpadding="0" style="font-family:arial, helvetica, sans-serif; color:#336666; font-size:10pt; font-weight:bold;">
    <tr> 
      <td colspan="3" bgcolor="#EBEBEB"><font color="#336699">Text Settings</font></td>
    </tr>
    <tr> 
      <td>Title</td>
      <td colspan=2> <input type="text" name="g_title" size="50" value="<? if ($g_title) { echo $g_title; } else { echo ""; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td>Description</td>
      <td colspan=2> <input type="text" name="g_desc" size="50" value="<? if ($g_desc) { echo $g_desc; } else { echo ""; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td colspan="3" bgcolor="#EBEBEB"><font color="#336699">Color Settings</font></td>
    </tr>
    <tr> 
      <td>Background Color</td>
      <td width="145"> <input type="text" id="g_bgcolor" name="g_bgcolor" onclick="box_clicked('g_bgcolor')" cols="7" maxlength="7" value="<? if ($g_bgcolor) { echo $g_bgcolor; } ?>"> 
      </td>
      <td width="156" rowspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><div id="colorbox_label" align="center"><font size=-1 color="#336699"">set 
                background color</font></div></td>
          </tr>
          <tr> 
            <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="180" height="140">
                <param name="movie" value="colorpicker.swf?func=color_selected">
                <param name="quality" value="high">
                <embed src="colorpicker.swf?func=color_selected" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="180" height="140"></embed></object></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>Title Text Color</td>
      <td> <input type="text" id="g_titlecolor" name="g_titlecolor" onclick="box_clicked('g_titlecolor')" cols="7" maxlength="7" value="<? if ($g_titlecolor) { echo $g_titlecolor; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td>Description Text Color</td>
      <td> <input type="text" id="g_desccolor" name="g_desccolor" onclick="box_clicked('g_desccolor')" cols="7" maxlength="7" value="<? if ($g_desccolor) { echo $g_desccolor; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td>Other Text Color</td>
      <td><input type="text" id="g_textcolor" name="g_textcolor" onclick="box_clicked('g_textcolor')" cols="7" maxlength="7" value="<? if ($g_textcolor) { echo $g_textcolor; } ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>Hyperlink Color</td>
      <td><input type="text" id="g_linkcolor" name="g_linkcolor" onclick="box_clicked('g_linkcolor')" cols="7" maxlength="7" value="<? if ($g_linkcolor) { echo $g_linkcolor; } ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>Visited Link Color</td>
      <td><input type="text" id="g_vlinkcolor" name="g_vlinkcolor" onclick="box_clicked('g_vlinkcolor')" cols="7" maxlength="7" value="<? if ($g_vlinkcolor) { echo $g_vlinkcolor; } ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3" bgcolor="#EBEBEB"><font color="#336699">Layout Settings</font></td>
    </tr>
    <tr> 
      <td>Columns per Page</td>
      <td colspan=2> <input type="text" name="g_cols" cols="50" value="<? if ($g_cols) { echo $g_cols; } else { echo "5"; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td>Rows per Page</td>
      <td colspan=2> <input type="text" name="g_rows" cols="50" value="<? if ($g_rows) { echo $g_rows; } else { echo "5"; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td>Thumbnail Image 
        <label> 
        <input name="g_thumb_worh" type="radio" value="w" <?php if($g_thumb_worh == 'w') echo "checked";?> >
        width</label> <label> 
        <input name="g_thumb_worh" type="radio" value="h" <?php if($g_thumb_worh == 'h') echo "checked";?> >
        height</label> <p>(you can specify either the width or the height of the 
          thumbnail.)</p></td>
      <td colspan=2> <input type="text" name="g_twidth" cols="50" value="<? if ($g_twidth) { echo $g_twidth; } else { echo "100"; } ?>"> 
      </td>
    </tr>
    <tr> 
      <td>Space between thumbs</td>
      <td colspan="2"><input name="g_spacing" type="text" id="g_spacing" value="<? if ($g_spacing) { echo $g_spacing; } else { echo "10"; } ?>"></td>
    </tr>
    <tr> 
      <td colspan="3" bgcolor="#EBEBEB"><font color="#336699">Other Settings</font></td>
    </tr>
    <tr> 
      <td>Display File name?</td>
      <td colspan=2> <input type="checkbox" name="g_dispFn" cols="50" value="check" <? if ($g_dispFn) { echo "checked"; } ?>> 
      </td>
    </tr>
    <tr> 
      <td>Sort according to File name?</td>
      <td> <input name="g_sortByFn" type="checkbox" id="g_sortByFn" value="check" cols="50" <? if ($g_sortByFn) { echo "checked"; } ?>> 
      </td>
      <td><input name="g_insensitive_sort" type="checkbox" id="g_insensitive_sort" value="check" cols="50" <? if ($g_insensitive_sort) { echo "checked"; } ?>>
        case insensitive</td>
    </tr>
    <tr> 
      <td>Folder Image:</td>
      <td colspan=2> <p> 
          <label> 
          <input type="radio" name="g_folderImg" value="1" <?php if($g_folderImg == "1") echo "checked"; ?> >
          default &quot;folder.gif&quot;</label>
          <br>
          <label> 
          <input type="radio" name="g_folderImg" value="2" <?php if($g_folderImg == "2") echo "checked"; ?> >
          first .gif file inside sub folder</label>
          <br>
          <label> 
          <input type="radio" name="g_folderImg" value="3" <?php if($g_folderImg == "3") echo "checked"; ?> >
          first image (jpg) inside folder</label>
          <br>
          <label> 
          <input type="radio" name="g_folderImg" value="4" <?php if($g_folderImg == "4") echo "checked"; ?> >
          random image (jpg) insider folder</label>
          <label></label>
          <br>
        </p></td>
    </tr>
    <tr> 
      <td align="center"><div align="left">Show full sized image in popup window?</div></td>
      <td align="center"> <div align="left"> 
          <input name="g_showInPopup" type="checkbox" id="g_showInPopup" value="check" cols="50" <? if ($g_showInPopup == "check") echo "checked"; ?> >
        </div></td>
      <td align="center"><div align="left"> 
          <p>popup window: <br>
            width 
            <input name="g_popupWidth" type="text" id="g_popupWidth" size="4" maxlength="4" value=<?php echo $g_popupWidth; ?> >
            height 
            <input name="g_popupHeight" type="text" id="g_popupHeight" size="4" maxlength="4" value=<?php echo $g_popupHeight; ?> >
          </p>
          <p><br>
            <input name="g_shrinkPopup" type="checkbox" id="g_shrinkPopup" value="check" cols="50" <? if ($g_shrinkPopup == "check") echo "checked"; ?> >
            shrink window size if image size is smaller then the default window 
            size </p>
        </div></td>
    </tr>
    <tr> 
      <td colspan="3" align="center"><input type="submit" value="Save Changes"></td>
    </tr>
  </table>

</form>

</body>
