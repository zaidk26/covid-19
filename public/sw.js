if(!self.define){const e=e=>{"require"!==e&&(e+=".js");let r=Promise.resolve();return s[e]||(r=new Promise(async r=>{if("document"in self){const s=document.createElement("script");s.src=e,document.head.appendChild(s),s.onload=r}else importScripts(e),r()})),r.then(()=>{if(!s[e])throw new Error(`Module ${e} didn’t register its module`);return s[e]})},r=(r,s)=>{Promise.all(r.map(e)).then(e=>s(1===e.length?e[0]:e))},s={require:Promise.resolve(r)};self.define=(r,i,c)=>{s[r]||(s[r]=Promise.resolve().then(()=>{let s={};const o={uri:location.origin+r.slice(1)};return Promise.all(i.map(r=>{switch(r){case"exports":return s;case"module":return o;default:return e(r)}})).then(e=>{const r=c(...e);return s.default||(s.default=r),s})}))}}define("./sw.js",["./workbox-56024e5b"],(function(e){"use strict";e.setCacheNameDetails({prefix:"covid-app-1586540897"}),self.addEventListener("message",e=>{e.data&&"SKIP_WAITING"===e.data.type&&self.skipWaiting()}),e.precacheAndRoute([{url:"css/app.css",revision:"9c787b2d8c611a5f49c3f10fae85149b"},{url:"favicon.ico",revision:"909187e7454bc16d69792ef7b2402f57"},{url:"ico/favicon.ico",revision:"909187e7454bc16d69792ef7b2402f57"},{url:"ico/manifest.json",revision:"b58fcfa7628c9205cb11a1b2c3e8f99a"},{url:"js/app.js",revision:"384ee3dfc7d4ae1bf02d2ee230005aa2"},{url:"manifest.json",revision:"798daf6507efcb69bbafeae16f670705"},{url:"mix-manifest.json",revision:"3ce66c06cabcb014f21123e3cacb205a"},{url:"particles.json",revision:"3f5a7b7794a70d983da2ec1b4df7667a"}],{}),e.registerRoute("/",new e.NetworkFirst,"GET")}));
//# sourceMappingURL=sw.js.map
