</ul>

<form method="POST">
    <input type='hidden' name='gateway' value='{$_REQUEST["gateway"] | htmlspecialchars}' />
    <input type='hidden' name='currency' value='{$_REQUEST["currency"] | htmlspecialchars}' />
    <input type='hidden' name='domain' value='{$_REQUEST["domain"] | htmlspecialchars}' />
    <input type='hidden' name='domains' value='{$_REQUEST["domains"] | htmlspecialchars}' />
    <input type='submit' value='back' />
</form>