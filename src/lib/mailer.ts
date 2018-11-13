'use strict';
const nodemailer = require('nodemailer');

// https://tylerkrys.ca/blog/adding-nodemailer-email-contact-form-node-express-app

var outlookTransporter = nodemailer.createTransport({
    service: "hotmail",
    auth: {
        user: process.env.MAIL_USER,
        pass: process.env.MAIL_PASSWORD
    }
});

// setup email data with unicode symbols
interface MailOptions {
    name: string
    from: string, // sender address
        to: string, // list of receivers
        subject: string, // Subject line
        text: string, // plain text body
};

export function sendMail(mailOptions: MailOptions) {
    return new Promise((resolve, reject) => {
        // send mail with defined transport object
        mailOptions.to = process.env.MAIL_USER; //"skills@cmmtechskills.com";
        const from = mailOptions.name + ' <' + mailOptions.from + '>';
        mailOptions.from = process.env.MAIL_USER;
        mailOptions.text = `${from}, said:\n${mailOptions.text}`;
        // console.log(JSON.stringify(mailOptions, null, 2));
        outlookTransporter.sendMail(mailOptions, (error, info) => {
            if (error) {
                console.log(error);
                reject(new Error(`${JSON.stringify(mailOptions)}\nERROR:${error}`));
            } else {
                resolve(info);
                console.log('Message sent: %s', info.messageId);
            }
        });
    });
}

export function subscribe(mailOptions: MailOptions) {
    return new Promise((resolve, reject) => {
        // send mail with defined transport object
        mailOptions.to = process.env.MAIL_USER;
        mailOptions.subject = "New Subscriber";
        mailOptions.text = `<${mailOptions.from}> would like to subscribe to new updates!`;
        mailOptions.from = process.env.MAIL_USER;
        outlookTransporter.sendMail(mailOptions, (error, info) => {
            if (error) {
                console.log(error);
                reject(new Error(`${JSON.stringify(mailOptions)}\nERROR:${error}`));
            } else {
                resolve(info);
                console.log('Message sent: %s', info.messageId);
            }
        });
    });
}