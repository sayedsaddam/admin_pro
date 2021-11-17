</body>
<style>
	@media print {
		.is-hidden-print {
			display: none;
		}
	}
</style>
<script>
	$(".nav-category").click(function () {
		$(this).siblings().toggle('fast');
	});
	$(".delete").click(function () {
		$(this).parent().hide();
	});
</script>
<script src="<?= base_url('assets/js/instantclick.min.js'); ?>" data-no-instant></script>
<script data-no-instant>
	var flag = true;
	function onlineUsers() {
		if (flag == true) {
			flag = false;
			setInterval(function () {
				var spanNumber = $('.viewing');
				var number = Math.floor(Math.random() * 12) + 3;
				spanNumber.text(number);
			}, 3000);
		}
	}
	InstantClick.on('change', function() {
		onlineUsers();		
	});
</script>
<script data-no-instant>InstantClick.init(100);</script>

</html>
