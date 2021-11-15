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
	$(document).ready(function () {
		setInterval(function () {
			var spanNumber = $('.viewing');
			var number = Math.floor(Math.random() * 12) + 3;
			spanNumber.text(number);
		}, 3000);
	});
</script>

<script src="<?= base_url('assets/js/instantclick.min.js'); ?>" data-no-instant></script>
<script data-no-instant>InstantClick.init();</script>

</html>
