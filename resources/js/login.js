import JustValidate from 'just-validate';

const login = new JustValidate('#formLogin', { submitFormAutomatically: true });

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
