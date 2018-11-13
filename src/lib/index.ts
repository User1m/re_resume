import * as path from 'path';
import * as express from 'express';
import * as bodyParser from 'body-parser';
import * as cors from 'cors';
import * as request from 'superagent';
import {
    ROOT
} from './path';
import {
    sendMail
} from './mailer';

const CMMTECH_ALERTS_ENDPOINT = 'https://hooks.slack.com/services/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';
const USERNAME = "CLAUDIUS MBEMBA ALERTER";
const port = process.env.PORT || 8082;
const app = express();
app.use(cors('*'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended: false
}));
app.use('/', express.static(path.join(ROOT, 'public')));

const server = app.listen(port, () => {
    console.info(`App server listening on port: ${port}`);
});

app.post('/contact', (req, res, next) => {
    const mailData = req.body;
    sendMail(mailData);
    res.status(204).send();
    // res.redirect(301, '/#contact');
});

// app.post('/subscribe', (req, res, next) => {
//     const email = req.body;
//     subscribe(email);
//     // res.redirect(301, '/#subscribe');
//     res.status(204).send();
// });

function notifySlack(msg: string, endpoint: string) {
    if (msg) {
        request
            .post(endpoint)
            .send({
                username: USERNAME,
                text: msg
            })
            .catch(error => {
                console.error(`ERROR POSTING TO SLACK: ${error}, stack: ${error.stack}`);
                console.error(error);
                throw error;
                // return { status: 'error' };
            });
    }
}

process.on('unhandledRejection', (reason, p) => {
    // https://stackoverflow.com/a/15699740/3562407
    p.catch(error => {
        const msg = 'Unhandled Rejection at: ' + error.stack + '\nreason: ' + reason.stack;
        console.error(msg);
        notifySlack(msg, CMMTECH_ALERTS_ENDPOINT);
    });
});

export = server;