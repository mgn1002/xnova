<style type="text/css"><!--
 @import url(./design/css/login.css);
--></style>

<div id="log_skipper"></div>

<div id="log_main">
  <div id="log_title">{L_log_reg} - {L_sys_universe} "{C_game_name}"</div>
  <div id="log_description">{L_log_reg_text0} <!-- IF URL_RULES --><a href="{URL_RULES}" style="color: red; text-decoration: underline; font-face: bold;"><!-- ENDIF -->{L_reg_with_rules}<!-- IF URL_RULES --></a><!-- ENDIF -->. {L_log_reg_text1}</div>

  <form name="registerForm" method="POST" action="reg.php{LANG}{referral}" onsubmit="changeAction('register');" >
    <input type="hidden" name="id_ref" value="{id_ref}">
    <table width="340" align="center">
      <tbody>
        <tr>
          <th width="179">{L_User_name}</th>
          <th width="161"><input name="username" type="text" size="20" maxlength="20" /></th>
        </tr>

        <tr>
          <th>{L_neededpass}:</th>
          <th><input name="password" type="password" size="20" maxlength="20" /></th>
        </tr>

        <tr>
          <th>{L_E-Mail}:</th>
          <th><input name="email" type="text" size="20" maxlength="40" /></th>
        </tr>

        <tr>
          <th>{L_MainPlanet}:</th>
          <th><input name="planet_name" type="text" size="20" maxlength="20" /></th>
        </tr>

        <tr>
          <th>{L_Sex}:</th>
  
          <th>
            <select name="sex">
              <option value="M" selected="selected">{L_Male}</option>
              <option value="F">{L_Female}</option>
            </select>
          </th>
        </tr>

        <!--
        <tr>
          <th>{L_Languese}:</th>
          <th>
            <select name="language">
              <option value="ru" selected="selected">{ru}</option>
            </select>
          </th>
        </tr>
        -->

        <tr>
          <th><img src="captcha.php" /></th>
          <th><input name="captcha" type="text" size="20" maxlength="20" /></th>
        </tr>
    
        <tr>
          <th colspan=2>
            <input type="hidden" name="language" value="ru">
            <input name="register" type="checkbox" value="1" /> {L_reg_i_agree} <!-- IF URL_RULES --><a href="{URL_RULES}" style="color: red; text-decoration: underline; font-face: bold;"><!-- ENDIF -->{L_reg_with_rules}<!-- IF URL_RULES --></a><!-- ENDIF -->
          </th>
        </tr>
      </tbody>
    </table>
    <input name="submit" type="submit" value="{L_signup}!" />
  </form><br>
  {L_log_reg_already} <a href="login.php{LANG}{referral}" class="link">{L_log_login_page}</a><br>
  {L_log_reg_already_lost} <a href="lostpassword.php{LANG}{referral}" class="link">{L_PasswordLost}</a><br>
  <br>

  <!-- INCLUDE login_menu.tpl -->
</div>
