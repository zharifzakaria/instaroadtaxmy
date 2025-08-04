<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('./connection/index.php'); //dev
include(ABS_PATH . '/connection/index.php'); //prod

if (isset($_POST['submit'])) {
  //get form data
  $t = $_POST["type"];
  $p = $_POST["plate"];
  $ic = preg_replace('/\-+/', "", $_POST["icno"]);
  $ph = $_POST["phone"];
  $pc = $_POST["postcode"];
  $e = $_POST["email"];
  $vkey = md5(time() . $p);

  $t = $mysqli->real_escape_string($t);
  $p  = $mysqli->real_escape_string($p);
  $ic  = $mysqli->real_escape_string($ic);
  $ph = $mysqli->real_escape_string($ph);
  $pc  = $mysqli->real_escape_string($pc);
  $e  = $mysqli->real_escape_string($e);
  $insert = $mysqli->query("INSERT into users(type, plate, icno,phone, postcode, email, vkey ) VALUES ('$t','$p','$ic','$ph','$pc','$e','$vkey')");
  if ($insert) {
//     //Send email
//     $from = "yana@instaroadtax.my";
//     $to = $e;
//     $subject = "⚡InstaRoadTax - Senarai sebutharga insuran untuk " . $t . " " . $p;
//     $message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
// <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
// <head>
// <!--[if gte mso 9]>
// <xml>
//   <o:OfficeDocumentSettings>
//     <o:AllowPNG/>
//     <o:PixelsPerInch>96</o:PixelsPerInch>
//   </o:OfficeDocumentSettings>
// </xml>
// <![endif]-->
//   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
//   <meta name="viewport" content="width=device-width, initial-scale=1.0">
//   <meta name="x-apple-disable-message-reformatting">
//   <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
//   <title></title>
  
//     <style type="text/css">
//       table, td { color: #000000; } a { color: #363675; text-decoration: none; }
// @media only screen and (min-width: 620px) {
//   .u-row {
//     width: 600px !important;
//   }
//   .u-row .u-col {
//     vertical-align: top;
//   }

//   .u-row .u-col-100 {
//     width: 600px !important;
//   }

// }

// @media (max-width: 620px) {
//   .u-row-container {
//     max-width: 100% !important;
//     padding-left: 0px !important;
//     padding-right: 0px !important;
//   }
//   .u-row .u-col {
//     min-width: 320px !important;
//     max-width: 100% !important;
//     display: block !important;
//   }
//   .u-row {
//     width: calc(100% - 40px) !important;
//   }
//   .u-col {
//     width: 100% !important;
//   }
//   .u-col > div {
//     margin: 0 auto;
//   }
// }
// body {
//   margin: 0;
//   padding: 0;
// }

// table,
// tr,
// td {
//   vertical-align: top;
//   border-collapse: collapse;
// }

// p {
//   margin: 0;
// }

// .ie-container table,
// .mso-container table {
//   table-layout: fixed;
// }

// * {
//   line-height: inherit;
// }

// a[x-apple-data-detectors="true"] {
//   color: inherit !important;
//   text-decoration: none !important;
// }

// </style>
  
  

// <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Sora:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->

// </head>
// <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000">
//   <!--[if IE]><div class="ie-container"><![endif]-->
//   <!--[if mso]><div class="mso-container"><![endif]-->
//   <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
//   <tbody>
//   <tr style="vertical-align: top">
//     <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
//     <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #ffffff;"><![endif]-->
// <div class="u-row-container" style="padding: 0px;background-color: transparent">
//   <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color:#554df0;">
//     <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
//       <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #017ed0;"><![endif]--> 
// <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
// <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
//   <div style="width: 100% !important;">
//   <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Open Sans\',sans-serif;" align="left">
//   <h1 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: \'Sora\',sans-serif; font-size: 22px;">
//     <strong>InstaRoadtax.my</strong>
//   </h1>
//       </td>
//     </tr>
//   </tbody>
// </table>
// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;font-family:\'Open Sans\',sans-serif;" align="left">
// <table width="100%" cellpadding="0" cellspacing="0" border="0">
//   <tr>
//     <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
//       <img align="center" border="0" src="https://instaroadtax.my/img/image-3.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;" width="580"/>
      
//     </td>
//   </tr>
// </table>
//       </td>
//     </tr>
//   </tbody>
// </table>
//   <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
//   </div>
// </div>
// <!--[if (mso)|(IE)]></td><![endif]-->
//       <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
//     </div>
//   </div>
// </div>
// <div class="u-row-container" style="padding: 0px;background-color: transparent">
//   <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f9f9f9;">
//     <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
//       <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f9f9f9;"><![endif]-->
      
// <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
// <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
//   <div style="width: 100% !important;">
//   <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:28px 33px 25px;font-family:\'Open Sans\',sans-serif;" align="left">
        
//   <div style="color: #444444; line-height: 200%; text-align: center; word-wrap: break-word;">
//     <p style="line-height: 200%; font-size: 14px;"><span style="font-size: 22px; line-height: 44px;">Salam,</span><br />Anda telah memohon sebutharga insuran untuk kenderaan pendaftaran ' .$p .'  melalui InstaRoadTax.my!</p>
//     <p style="line-height: 200%; font-size: 14px;">Klik capaian di bawah 👇 untuk melihat sebutharga bagi insuran kenderaan anda.</p>
//   </div>
//       </td>
//     </tr>
//   </tbody>
// </table>

//   <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
//   </div>
// </div>
// <!--[if (mso)|(IE)]></td><![endif]-->
//       <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
//     </div>
//   </div>
// </div>



// <div class="u-row-container" style="padding: 0px;background-color: transparent">
//   <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f9f9f9;">
//     <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
//       <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f9f9f9;"><![endif]-->
      
// <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
// <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
//   <div style="width: 100% !important;">
//   <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 0px;font-family:\'Open Sans\',sans-serif;" align="left">
        
// <div align="center">
//   <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;font-family:\'Open Sans\',sans-serif;"><tr><td style="font-family:\'Open Sans\',sans-serif;" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:49px; v-text-anchor:middle; width:302px;" arcsize="81.5%" stroke="f" fillcolor="#272362"><w:anchorlock/><center style="color:#FFFFFF;font-family:\'Open Sans\',sans-serif;"><![endif]-->
//     <a href="'."https://instaroadtax.my/rg/view.php?vkey=" .$vkey .'" target="_blank" style="box-sizing: border-box;display: inline-block;font-family:\'Open Sans\',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #554df0; border-radius: 40px;-webkit-border-radius: 40px; -moz-border-radius: 40px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
//       <span style="display:block;padding:15px 44px;line-height:120%;"><span style="font-size: 16px; line-height: 19.2px;"><strong><span style="line-height: 19.2px; font-size: 14px;">Lihat sebutharga sekarang</span></strong></span></span>
//     </a>
//   <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
// </div>

//       </td>
//     </tr>
//   </tbody>
// </table>

// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:18px;font-family:\'Open Sans\',sans-serif;" align="left">
        
//   <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="84%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #d8d0d0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
//     <tbody>
//       <tr style="vertical-align: top">
//         <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
//           <span>&#160;</span>
//         </td>
//       </tr>
//     </tbody>
//   </table>

//       </td>
//     </tr>
//   </tbody>
// </table>

//   <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
//   </div>
// </div>
// <!--[if (mso)|(IE)]></td><![endif]-->
//       <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
//     </div>
//   </div>
// </div>



// <div class="u-row-container" style="padding: 0px;background-color: transparent">
//   <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f9f9f9;">
//     <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
//       <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f9f9f9;"><![endif]-->
      
// <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
// <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
//   <div style="width: 100% !important;">
//   <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:19px 33px 40px;font-family:\'Open Sans\',sans-serif;" align="left">
        
//   <div style="color: #272362; line-height: 200%; text-align: center; word-wrap: break-word;">
//     <p style="font-size: 14px; line-height: 200%;"><span style="font-size: 22px; line-height: 27px;">Urusan perlindungan kenderaan lebih pantas dengan InstaRoadtax.my </span></p>
//   </div>

//       </td>
//     </tr>
//   </tbody>
// </table>

//   <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
//   </div>
// </div>
// <!--[if (mso)|(IE)]></td><![endif]-->
//       <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
//     </div>
//   </div>
// </div>


// <div class="u-row-container" style="padding: 0px;background-color: transparent">
//   <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #272362;">
//     <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
//       <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #272362;"><![endif]-->
      
// <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
// <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
//   <div style="width: 100% !important;">
//   <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 4px 4px;font-family:\'Open Sans\',sans-serif;" align="left">
        
// <div align="center">
//   <div style="display: table; max-width:254px;">
//   <!--[if (mso)|(IE)]><table width="254" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:254px;"><tr><![endif]-->
  
    
//     <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 19px;" valign="top"><![endif]-->
//     <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 19px">
//       <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
//         <a href="//fb.com/instaroadtax" title="Facebook" target="_blank">
//           <img src="https://instaroadtax.my/img/image-2.png" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
//         </a>
//       </td></tr>
//     </tbody></table>
//     <!--[if (mso)|(IE)]></td><![endif]-->
//     <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
//   </div>
// </div>

//       </td>
//     </tr>
//   </tbody>
// </table>

// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:23px 40px 10px;font-family:\'Open Sans\',sans-serif;" align="left">
        
//   <div style="color: #dadada; line-height: 140%; text-align: center; word-wrap: break-word;">
//     <p style="font-size: 14px; line-height: 140%;">WhatsApp : 010 231 7905<br />Email: instaroadtax@gmail.com <br />TP Success Trading (TR0251018-U),<br /> Prima Saujana Kajang,43000 Kajang, SELANGOR</p>
//   </div>

//       </td>
//     </tr>
//   </tbody>
// </table>

// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:19px 19px 0px;font-family:\'Open Sans\',sans-serif;" align="left">
        
//   <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="91%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #616888;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
//     <tbody>
//       <tr style="vertical-align: top">
//         <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
//           <span>&#160;</span>
//         </td>
//       </tr>
//     </tbody>
//   </table>

//       </td>
//     </tr>
//   </tbody>
// </table>

// <table style="font-family:\'Open Sans\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
//   <tbody>
//     <tr>
//       <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 40px;font-family:\'Open Sans\',sans-serif;" align="left">
        
//   <div style="color: #bbbbbb; line-height: 140%; text-align: center; word-wrap: break-word;">
//     <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 12px; line-height: 16.8px;">&copy; instaroadtax.my&nbsp;</p>
//   </div>

//       </td>
//     </tr>
//   </tbody>
// </table>

//   <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
//   </div>
// </div>
// <!--[if (mso)|(IE)]></td><![endif]-->
//       <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
//     </div>
//   </div>
// </div>


//     <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
//     </td>
//   </tr>
//   </tbody>
//   </table>
//   <!--[if mso]></div><![endif]-->
//   <!--[if IE]></div><![endif]-->
// </body>

// </html>';
//     $headers = "From: Yana - ⚡Insta Roadtax <" . $from  . ">\r\n";
//     $headers .= "MIME-Version: 1.0" . "\r\n";
//     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//     mail($to, $subject, $message, $headers);
    header('location: thankyou.php');
  } else {
    echo $mysqli->error;
  }
}
