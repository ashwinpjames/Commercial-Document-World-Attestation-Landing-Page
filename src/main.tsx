import React from 'react';import ReactDOM from 'react-dom/client';import {HelmetProvider} from 'react-helmet-async';import App from './App';import './styles.css';import {installAnalytics} from './lib/analytics';
// Analytics is intentionally not installed until the visitor makes a cookie choice.
try{if(localStorage.getItem('wa-consent')==='all')installAnalytics()}catch{}
ReactDOM.createRoot(document.getElementById('root')!).render(<React.StrictMode><HelmetProvider><App/></HelmetProvider></React.StrictMode>);
