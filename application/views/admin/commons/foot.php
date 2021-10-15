</body>
<style>
    @media print {
		.is-hidden-print {
			display: none;
		}
	}
</style>
<script>
    $(document).ready(function () {
		$(".nav-category").click(function () {
			$(this).siblings().toggle('fast');
		});
        $(".delete").click(function () {
			$(this).parent().hide();
		});
	});
</script>
</html>
