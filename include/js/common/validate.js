var validateEmail;

validateEmail = function (p_value) {
	if (p_value ==='') {
		return 'Email을 입력하여주십시요.';
	} else if (!((p_value.indexOf('.') > 0 && (p_value.indexOf('@') > 0)) || /[^a-zA-Z0-9.@_-]/.test(p_value)) {
		return '이메일 형식이 맞지 않습니다.\n';
		// return ''
	}
};