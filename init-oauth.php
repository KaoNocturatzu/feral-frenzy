<?php

$discord_url = "https://discord.com/api/oauth2/authorize?client_id=1089577834579771590&redirect_uri=https%3A%2F%2Flocalhost%2Fstarmaninja%2Fprocess-oauth.php&response_type=code&scope=identify%20guilds%20guilds.members.read";
header("Location: $discord_url");
exit();

?>