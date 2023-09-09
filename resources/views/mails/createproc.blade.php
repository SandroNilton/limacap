<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">

  <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
    <td>
      <p>
        Colegio de Arquitectos del Perú
      </p>
      <img src="https://limacap.org/wp-content/uploads/2021/12/logo-niubiz.jpg" height="300" width="300" style="margin: -15px">
        <h1>Asunto: Nueva Solicitud Trámite documentario – expediente </h1>
      <p>
        Le informamos que la solicitud con número de expediente {{ $data['idprocedure'] }} de tipo de trámite ({{ $data['typeprocedure'] }}) categoría ha sido registrada.
      </p>
      <p>
        Puede visualizar la solicitud en el siguiente link: <a href="https://mesalimacap-ojczk.ondigitalocean.app/procedures/{{ $data['idprocedure'] }}">link del trámite</a>
      </p>
    </td>
    </tr>
    </table>

</td>
</tr>
</table>
</td>
</tr>

<tr>
  <td>
  <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
  <td class="content-cell" align="center">
    Contáctanos
  </td>
  </tr>
  </table>
  </td>
  </tr>

</table>
</td>
</tr>
</table>
</body>
</html>

