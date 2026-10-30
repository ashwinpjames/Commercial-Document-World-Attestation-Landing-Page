# Reliance World Attestation bilingual landing site

A React 18 + Vite + TypeScript application for a separate Hostinger subdomain. English is served at `/` and Arabic at `/ar/`. The build includes a Puppeteer prerender step so the HTML snapshots contain the rendered content.

## Before publishing

1. Replace every `[SUBDOMAIN]` token with the selected subdomain, including `src/components/SEO.tsx`, `src/lib/seo.ts`, `public/.htaccess`, `public/robots.txt`, and `public/sitemap.xml`.
2. Supply the approved logo master. The supplied logo URL could not be retrieved in this environment. `public/assets/logo.svg` is a temporary typographic placeholder, not the client logo. Replace it with an approved SVG or high-resolution PNG master before launch.
3. Have a native Arabic-speaking reviewer approve the Arabic copy, terminology and search phrasing.
4. Confirm the legal entity, trade licence, hours, country list, document-specific requirements, exact meaning of “membership of formation”, Certificate of Origin and packing-list availability, Ministry of Economy steps, fees and turnaround times.
5. Confirm that the client still approves the Google rating and review count (4.6 from 315) and that the supplied Google link opens the correct Business Profile.
6. Review the PHP mail endpoint with the Hostinger mail configuration and set `CONTACT_TO` if environment variables are supported. Test spam controls and delivery. Consider a reputable transactional email provider for production reliability.
7. The `privacy-policy` and `terms` pages, cookie-consent compliance wording and analytics consent controls require final legal review before launch. This implementation stores preference and gates GA4 loading; it is not a full consent-management platform.

## Local development

```bash
npm install
npm run dev
```

## Production build and prerender

```bash
npm run typecheck
npm run build
```

`npm run build` runs TypeScript, Vite and Puppeteer prerendering. Puppeteer downloads a compatible browser during install on most environments. If Hostinger's build environment cannot run Chromium, build locally and upload the generated `dist/` folder instead. Hostinger only needs to serve the static `dist/` files and the PHP contact endpoint.

## Hostinger deployment

1. In hPanel, open **Domains → Subdomains**, create `[SUBDOMAIN].worldattestation.com`, and set its document root to a dedicated folder such as `public_html/[SUBDOMAIN]`. Do not point it at the parent WordPress document root.
2. Confirm DNS. If the subdomain is hosted on the same Hostinger account, hPanel may create the record automatically. Otherwise create the A or CNAME record Hostinger specifies. Wait for DNS propagation.
3. Activate SSL for the subdomain in hPanel. Test `https://[SUBDOMAIN].worldattestation.com` before forcing HTTPS.
4. Run the build locally. Upload the **contents** of `dist/` into the subdomain document root, preserving `/assets`, `/ar`, `/api`, `.htaccess`, `robots.txt` and `sitemap.xml`.
5. Ensure PHP is enabled for `/api/contact.php`. Test a real form submission and confirm delivery to `info@worldattestation.com`. Configure SPF, DKIM and DMARC for the sending domain as appropriate.
6. Check `/robots.txt`, `/sitemap.xml`, `/ar/`, and a missing URL (404). Replace the placeholder subdomain in all files before upload.
7. In Google Search Console, add a Domain property and verify it using the DNS TXT record, or add a URL-prefix property for the subdomain. Submit the sitemap. Inspect both `/` and `/ar/` and request indexing where appropriate.
8. Use the same GA4 property as the parent website. Configure cross-domain measurement for the parent and subdomain domains in the GA4 web stream, and verify linker/cookie continuity using Tag Assistant and a test journey. Set `VITE_GA4_ID` at build time. The current code loads GA4 only if the visitor previously selected “Accept all”.
9. Add the Google Search Console verification meta tag and Google Tag Manager only after providing the real IDs. Do not put secrets in client-side environment variables. GTM is not enabled in this starter.
10. Test Lighthouse on both language URLs and themes, real mobile devices, RTL navigation, keyboard access, forms, chatbot and cookie choices.

## SEO and content notes

- The intended keyword split is broad/general document attestation on the existing WordPress page and business/commercial document attestation on this bilingual subdomain. Add reciprocal contextual links only after the parent page copy and internal linking are reviewed.
- `GOOGLE_PROFILE_URL` is a single config constant used for rating/review links and schema `sameAs`. No Review or AggregateRating schema is emitted.
- Google review cards link to the profile listing, not individual reviews. The supplied review copy is reproduced as supplied and tagged by service. These are not commercial-document customer reviews.
- The displayed rating and count are static client-supplied data. Refresh before launch and periodically afterward.
- No confirmed commercial-country list, fees, service turnaround, operating hours, trade licence or legal entity information was supplied. Placeholders remain intentional.
- The Arabic copy is draft Modern Standard Arabic and requires native-speaker review. The current CSS requests Cairo from Google Fonts; self-host a subsetted Arabic font and preload it before production if the self-hosting requirement is strict. Arabic keyword options are not validated by keyword-volume data.

## Chatbot

The chatbot is rule-based and only uses the provided process summary. It cannot quote fees or processing times. To add an AI assistant later, send requests to a PHP proxy on the server, keep the model API key in server environment configuration, validate and rate-limit requests, and never ship API keys in React/Vite client code.

## Analytics

Events wired in the UI: `whatsapp_click`, `call_click`, `chatbot_open`, `google_reviews_click`, and `form_submit`. GA4 initialization is consent-gated by the stored `wa-consent` choice. Before production, implement a compliant consent-management platform if required by the business's legal obligations and ensure all optional tags respect the consent state.

## Current official process verification

The process cards intentionally retain the client-supplied two-route outline as provisional copy. The UAE MOFA's current attestation page says the appropriate route is determined from the issuing authority and document type, with digital attestation or approved courier pathways. Confirm the current requirements for commercial documents directly with MOFA before publishing the route as definitive: https://www.mofa.gov.ae/EN/Services/Attestation. Ministry of Economy eServices are linked as a separate official reference: https://www.moec.gov.ae/en/services.
