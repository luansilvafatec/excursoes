import JustValidate from 'just-validate';
import JustValidatePluginDate from 'just-validate-plugin-date';

const login = new JustValidate('#formLogin', { submitFormAutomatically: true });
const cadastro = new JustValidate('#formCadastro', { submitFormAutomatically: true, });

login.addField('#cpf_login', [{
    rule: 'required',
    errorMessage: 'O CPF é obrigatório',
},
{
    rule: 'minLength',
    value: 14,
},
{
    rule: 'maxLength',
    value: 14,
},
])
    .addField('#password_login', [{
        rule: 'required',
        errorMessage: 'A senha é obrigatória',
    },
    {
        rule: 'minLength',
        value: 3,
    },
    {
        rule: 'maxLength',
        value: 255,
    },
    ]);

cadastro
    .onSuccess((event) => {
        console.log(event.target);
        event.target.submit();

    })
    .addRequiredGroup('#tipo', 'Selecione sua relação atual com a Fatec Ourinhos')
    .addField('#nome', [{
        rule: 'required',
        errorMessage: 'Digite seu nome completo',
    },
    {
        rule: 'minLength',
        value: 10,
        errorMessage: 'Digite seu nome completo',
    }])
    .addField('#nascimento', [
        {
            plugin: JustValidatePluginDate(() => ({
                required: true,
                isAfter: '1924-01-01',
                isBefore: '2010-12-31',
            })),
            errorMessage: 'Digite sua data de nascimento',
        },
    ])
    .addField('#rg', [{
        rule: 'required',
        errorMessage: 'Digite seu RG',
    },
    {
        rule: 'minLength',
        value: 7,
        errorMessage: 'Digite seu RG',
    }])
    .addField('#cpf', [{
        rule: 'required',
        errorMessage: 'Digite seu CPF',
    },
    {
        rule: 'minLength',
        value: 14,
        errorMessage: 'Digite seu CPF completo',
    },
    {
        rule: 'maxLength',
        value: 14,
        errorMessage: 'Digite seu CPF corretamnete',
    },
    {
        validator: (value) => () =>
            new Promise((resolve) => {
                fetch('/validacpf', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ cpf: value }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.valid) {
                            resolve(true); // CPF válido
                        } else {
                            resolve(false); // CPF inválido
                        }
                    })
                    .catch(() => {
                        resolve(false); // Erro na validação
                    });
            }),
        errorMessage: 'CPF inválido!',
    }])
    .addField('#email', [
        {
            rule: 'required',
            errorMessage: 'Email é obrigatório',
        },
        {
            rule: 'email',
            errorMessage: 'Email inválido',
        },
    ])
    .addField('#celular', [
        {
            rule: 'required',
            errorMessage: 'O número de celular é obrigatório',
        },
        {
            rule: 'customRegexp',
            value: /^(?:(?:\+)?(55)\s?)?(?:\(?(?:[0-0]?([1-9]{1}[1-9]{1}))\)?\s?)([1-9](?:\s?\.?)\d{4}\-?\d{4})$/,
            errorMessage: 'Número de celular inválido!',
        },
    ])
    .addField('#curso', [
        {
            rule: 'required',
            errorMessage: 'Curso é obrigatório',
        }
    ])
    .addField('#semestre', [
        {
            rule: 'required',
            errorMessage: 'Semestre é obrigatório',
        }
    ])
    .addField('#password', [
        {
            rule: 'required',
            errorMessage: 'Senha é obrigatório',
        }
    ])
    .addField('#confirmasenha', [
        {
            rule: 'required',
            errorMessage: 'Confirmação de senha é obrigatório',
        },
        {
            validator: (value, fields) => {
                if (
                    fields['#password'] &&
                    fields['#password'].elem
                ) {
                    const repeatPasswordValue =
                        fields['#password'].elem.value;

                    return value === repeatPasswordValue;
                }

                return true;
            },
            errorMessage: 'A confirmação deve ser igual a senha',
        },
    ]);

document
    .querySelector('#tipo')
    .addEventListener('change', (e) => {
        if (e.target.value == 2) {
            cadastro.removeField('#semestre');
            cadastro.addField('#curso', [
                {
                    rule: 'required',
                    errorMessage: 'Curso é obrigatório',
                }
            ]);
        } else if (e.target.value == 3) {
            cadastro.removeField('#curso');
            cadastro.removeField('#semestre');
        } else {
            cadastro.addField('#curso', [
                {
                    rule: 'required',
                    errorMessage: 'Curso é obrigatório',
                }
            ])
                .addField('#semestre', [
                    {
                        rule: 'required',
                        errorMessage: 'Semestre é obrigatório',
                    }
                ]);
        }
    });
