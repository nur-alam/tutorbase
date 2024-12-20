document.addEventListener('DOMContentLoaded', function () {
	const installationWrapper = document.querySelector('.installation-progress-wrapper');
	const successWrapper = document.querySelector('.success-block-wrapper');
	const modalFooter = document.querySelector('.modal-footer');
	const modalWrapper = document.getElementById('modal-wrapper');
	const modalOverlay = document.querySelector('.modal-wrapper-overlay');
	const modalContent = document.querySelector('.modal-content');
	const importBtns = document.querySelectorAll('.import-btn');
	const importNowBtn = document.querySelector('.import-now');
	const importCancelBtn = document.getElementById('import-cancel-btn');
	const modalHead = document.querySelector('.modal-head');
	const modalHeading = document.querySelector('.modal-head h3');
	const dangerBlock = document.querySelector('.danger-block');
	let isModalClosable = true;
	let templateId = null;

	[...importBtns].forEach((item) => {
		item.addEventListener('click', (event) => {
			templateId = item.dataset.template;
			modalWrapper.style.display = 'flex';
			const singleItem = item.closest('.single-item');
			const template = singleItem.querySelector('.template-name');
			modalHeading.innerText = template.innerText + ' Template';
		});
	});

	modalOverlay.addEventListener('click', modalDisable);
	importCancelBtn.addEventListener('click', modalDisable);

	function modalDisable() {
		if (isModalClosable) {
			modalWrapper.style.display = 'none';
			resetModal();
		}
	}

	const importItem = document.querySelectorAll('.import-item');
	const importItemSpinner = document.querySelectorAll('.import-item .svg-spinner');
	const svgCircle = document.querySelectorAll('.import-item .svg-circle');
	const svgSpinner = document.querySelectorAll('.import-item .svg-spinner');
	const progressBar = document.querySelector('.progress-status');
	const progressNumberDiv = document.querySelector('.percentage-number');
	const contentDetails = document.getElementById('content-details');
	const plugins_array = ['tutor', 'droip'];

	importNowBtn.addEventListener('click', plugin_installation);
	let progressBarInitialWidth = 0;
	let progressNumber = 0;
	async function plugin_installation() {
		progressBarInitialWidth = 10;
		progressNumber = 10;
		progressBar.style.width = `${progressBarInitialWidth}%`;
		progressNumberDiv.innerText = `${progressNumber}%`;
		let pluginInstallationDone = false;
		isModalClosable = false;
		dangerBlock.innerText = '';
		dangerBlock.style.display = 'none';

		importNowBtn.setAttribute('disabled', 'disabled');
		importNowBtn.innerText = 'Importing';
		for (let i = 0; i < plugins_array.length; i++) {
			importItemSpinner[i].classList.add('active');
			let data = new FormData();
			data.append('action', 'install_plugins');
			data.append('nonce_value', tutorowl.nonce_value);
			data.append('plugin_name', plugins_array[i]);
			pluginInstallationDone = false;
			let response = await fetch(tutorowl.ajax_url, {
				method: 'POST',
				body: data,
			});
			if (!response.ok) {
				console.log('Network error! plz try again!');
				break;
			}
			let res = await response.json();
			if (res.success) {
				progressUpgrader();
				svgSpinner[i].style.display = 'none';
				svgCircle[i].style.display = 'block';
				pluginInstallationDone = true;
			} else {
				retryImportDomUpdate();
				return;
			}
		}

		if (pluginInstallationDone) {
			try {
				importItemSpinner[importItemSpinner.length - 1].classList.add('active');
				const templateImportResponse = await importContent();
				// console.log(templateImportResponse);
				// return;
				const importRes = await templateImportResponse.json();
				if (templateImportResponse.ok && importRes.success) {
					contentDetails.innerHTML = `Downloading <span style="color: #5FAC23; font-weight: 600;">assets...</span>`;
					processImportedTemplate();
				} else {
					if ('License missing' == importRes.message) {
						retryImportDomUpdate('License missing, Upgrade to pro.');
						return;
					}
					pluginInstallationDone = false;
				}
			} catch (error) {
				console.log('try catch error!');
				pluginInstallationDone = false;
			}
			// finally {
			// 	console.log('try catch finally error!');
			// 	pluginInstallationDone = false;
			// }
		}
		if (!pluginInstallationDone) {
			retryImportDomUpdate();
		}
	}

	const importContent = async () => {
		let importFormData = new FormData();
		importFormData.append('action', 'import_droip_template');
		importFormData.append('nonce_value', tutorowl.nonce_value);
		importFormData.append('template_id', templateId);
		console.log('fetch template id ', templateId);
		let response = await fetch(tutorowl.ajax_url, {
			method: 'POST',
			body: importFormData,
		});
		return response;
	};

	const processImportedTemplate = () => {
		let importFormData = new FormData();
		importFormData.append('action', 'process_droip_template');
		importFormData.append('nonce_value', tutorowl.nonce_value);
		fetch(tutorowl.ajax_url, {
			method: 'POST',
			body: importFormData,
		})
			.then((res) => res.json()) // Parse response as JSON
			.then((res) => {
				if (res.success) {
					let data = res.success;
					if (data.status === 'importing') {
						if (data.queue.length) {
							contentDetails.innerHTML = `Downloading <span style="color: #5FAC23; font-weight: 600;"> ${data.queue[0]}... </span>`;
						}
						setTimeout(() => {
							processImportedTemplate();
						}, 10);
					} else if (data.status === 'done') {
						console.log('import done!');
						contentDetails.innerHTML = ``;
						progressUpgrader();
						setTimeout(() => {
							successModal();
						}, 300);
					}
				}
			});
	};

	const progressUpgrader = () => {
		progressBarInitialWidth = progressBarInitialWidth + 30;
		progressNumber = progressNumber + 30;
		progressBar.style.width = `${progressBarInitialWidth}%`;
		progressNumberDiv.innerText = `${progressNumber}%`;
	};

	const successModal = () => {
		svgSpinner[svgSpinner.length - 1].style.display = 'none';
		svgCircle[svgCircle.length - 1].style.display = 'block';
		installationWrapper.style.display = 'none';
		successWrapper.style.display = 'flex';
		modalFooter.style.display = 'none';
		pluginInstallationDone = true;
		importNowBtn.removeAttribute('disabled');
		importNowBtn.innerText = 'Import Now';
		isModalClosable = true;
	};

	const resetModal = () => {
		progressBarInitialWidth = 0;
		progressNumber = 0;
		progressNumberDiv.innerText = `0%`;
		progressBar.style.width = `0%`;
		installationWrapper.style.display = 'flex';
		successWrapper.style.display = 'none';
		modalFooter.style.display = 'grid';
		dangerBlock.innerText = '';
		dangerBlock.style.display = 'none';
		pluginInstallationDone = false;
		importNowBtn.removeAttribute('disabled');
		importNowBtn.innerText = 'Import Now';
		isModalClosable = true;
		importItemSpinner.forEach((spinner) => {
			spinner.classList.remove('active');
			spinner.style.display = 'block';
		});
		svgCircle.forEach((circle) => {
			circle.style.display = 'none';
		});
	};

	const retryImportDomUpdate = (message = 'Something went wrong!!, plz try again!') => {
		isModalClosable = true;
		importNowBtn.removeAttribute('disabled');
		importNowBtn.innerText = 'Import Now';
		dangerBlock.innerText = message;
		dangerBlock.style.display = 'block';
		importItemSpinner.forEach((item) => {
			if (item.classList.contains('active')) {
				item.classList.remove('active');
			}
		});
	};
});
