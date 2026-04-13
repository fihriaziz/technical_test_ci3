<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($this->router->class !== 'auth'): ?>
		</main>
	</div>
<?php endif; ?>

<script>
	(function () {
		const addButton = document.querySelector('[data-add-item]');
		const body = document.querySelector('[data-items-body]');

		if (!addButton || !body) {
			return;
		}

		const template = document.getElementById('invoice-item-template');

		function bindRow(row) {
			const removeButton = row.querySelector('[data-remove-item]');
			const qtyInput = row.querySelector('[data-qty]');
			const priceInput = row.querySelector('[data-price]');
			const totalInput = row.querySelector('[data-total]');

			function recalc() {
				const qty = parseFloat(qtyInput.value || 0);
				const price = parseFloat(priceInput.value || 0);
				totalInput.value = (qty * price).toLocaleString('id-ID');
			}

			qtyInput.addEventListener('input', recalc);
			priceInput.addEventListener('input', recalc);
			removeButton.addEventListener('click', function () {
				if (body.children.length > 1) {
					row.remove();
				}
			});

			recalc();
		}

		Array.from(body.children).forEach(bindRow);

		addButton.addEventListener('click', function () {
			const clone = template.content.cloneNode(true);
			const row = clone.querySelector('tr');
			body.appendChild(row);
			bindRow(row);
		});
	})();
</script>
</body>
</html>