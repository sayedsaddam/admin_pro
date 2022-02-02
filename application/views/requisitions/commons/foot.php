</body>
<style>
	@media print {
		.is-hidden-print {
			display: none;
		}
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
	let darkmode = new Darkmode();
	$(".toggle-darkmode").click(function() {
		darkmode.toggle();
	});
</script>
<script data-no-instant>
	$( document ).ready(function() {
		$(".nav-category").click(function () {
			$(this).siblings().toggle('fast');
		});
		$(".delete").click(function () {
			$(this).parent().hide();
		});	
	});
</script>

</html>
