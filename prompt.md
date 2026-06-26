# Master Prompt — Create a New Country SEO Page for UX Pacific

## What This Task Is

You are creating a new programmatic SEO gateway page for **UX Pacific** (`https://www.uxpacific.com`), a UI/UX design agency. The site has thousands of location pages. This task creates one **country-level hub page** — a Tier 1 page that links down to state/region children pages.

The master template is `C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-germany.php`.  
A completed second example is `C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-india.php`.

Read both files before starting. The India page shows how Germany was adapted — use the same diff pattern for whichever country you are creating.

---

## File Creation Process (CRITICAL — follow this exactly)

The Write tool blocks creation of files it has never read. Use this three-step process every time:

```
Step 1: PowerShell — create an empty placeholder
  New-Item -ItemType File -Path "C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-[slug].php" -Force | Out-Null

Step 2: Read tool — read the empty file (satisfies the Write tool requirement)
  Read: C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-[slug].php

Step 3: Write tool — write the full page content
  Write: C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-[slug].php
```

After writing, also add the country to `C:\xampp\htdocs\UX_Pacific\sitemap-core.xml` using the Edit tool (append before the closing `</urlset>` tag).

---

## Page Structure (do not change this)

The page has exactly these sections in this order — do not add, remove, or reorder sections:

1. PHP variables block (`$countrySlug`, `$pageTitle`, `$pageDesc`, `$metaKeywords`, `$metaAuthor`, `$metaRobots`, `$themeColor`, `$geoRegion`, `$geoCountry`, `$contentLanguage`, `$canonicalUrl`, `$ogTitle`, `$ogDesc`, `$ogUrl`, `$ogImage`, `$ogLocale`, `$currentPage`)
2. `$_gFaqs` array — 10 country-specific FAQ pairs
3. `$_schemaFaqs` mapping (identical boilerplate, copy as-is)
4. `$ldJson` schema `@graph` (5 nodes: WebPage, BreadcrumbList, Organization, Service, FAQPage)
5. `$hubChildren` array — states/regions for this country
6. HTML: DOCTYPE, head include, navbar include
7. Hero section
8. Inline `<style>` block (`.de-*` CSS — copy identically from Germany, no changes)
9. Breadcrumb nav
10. Why Trust UX Pacific (Trust cards + credibility strip)
11. Services (6 cards)
12. UXPACIFIC Insight Framework™ (6 steps)
13. What You Receive (6 deliverable cards)
14. Traditional vs UX Pacific (comparison table)
15. Our UX Delivery Process (7 steps)
16. Expert Team Framework (3 team cards)
17. FAQs accordion
18. States/Regions Hub
19. CTA box
20. footer.php and scripts.php includes
21. Audit success popup + audit modal + validation JS (copy identically)

---

## What to Change Per Country

Everything not listed below is **copied identically** from the India page.

### 1 — PHP Variables (top of file)

| Variable | Rule |
|---|---|
| `$countrySlug` | lowercase hyphenated slug, e.g. `'united-kingdom'` |
| `$pageTitle` | `'UI UX Design Agency in [Country] | UX Pacific'` |
| `$pageDesc` | ~155 chars. Mention primary compliance law. e.g. `'UK GDPR-compliant UI/UX design for British businesses...'` |
| `$metaKeywords` | `'UI UX Design [Country], UI UX Agency [Country], UX Design [Country], UX Research [Country], UI Design [Country], Product Design [Country], UX Audit [Country], Usability Testing [Country], UX Consultant [Country], UX Company [Country], Design System [Country], SaaS UX [Country], UX Agency [City1], UX Agency [City2], UX Agency [City3], UX Agency [City4]'` |
| `$geoRegion` | ISO 3166-1 alpha-2 code (see reference table below) |
| `$geoCountry` | Full country name as a string |
| `$contentLanguage` | e.g. `'en-GB'`, `'en-US'`, `'en-AU'` |
| `$canonicalUrl` | `'https://www.uxpacific.com/ui-ux-design-agency-in-[slug]'` |
| `$ogTitle` | Same as `$pageTitle` |
| `$ogDesc` | ~155 chars. Mention compliance law + major cities. |
| `$ogUrl` | Same as `$canonicalUrl` |
| `$ogImage` | `'https://www.uxpacific.com/img/og-[slug].jpg'` |
| `$ogLocale` | e.g. `'en_GB'`, `'en_US'`, `'en_AU'` |
| `$currentPage` | Always `''` (empty string) |

### 2 — FAQs (`$_gFaqs`) — 10 unique questions

Write 10 questions specific to this country. Use the India FAQs as the structural template but replace all country-specific details. Required topics to cover:

1. "Do you provide UI UX design services in [Country]?" — confirm coverage + list major cities
2. "How does [PRIMARY COMPLIANCE LAW] affect UX design for [Country] businesses?" — explain UX implications
3. "Can you design for [local language/script consideration]?" — e.g. RTL for Arabic, French text length, Kanji etc. If English-only market, replace with "multilingual" question
4. "Can you work with [market segment] in [City]?" — name their dominant startup/tech scene
5. "How much does UX design cost for a [Country] business?" — use local currency, realistic range
6. "Does UX Pacific design for [ACCESSIBILITY LAW]?" — local accessibility standard
7. "Can you redesign an existing digital product?" — keep mostly generic but mention market
8. "Can you sign an NDA?" — mention local data protection standard by name
9. "How does remote collaboration work for [Country] clients?" — mention timezone
10. "How quickly do you respond to enquiries from [Country]?" — keep standard response

### 3 — Schema `$ldJson`

Change only these fields, copy everything else verbatim:

```php
'@id'  => 'https://www.uxpacific.com/ui-ux-design-agency-in-[slug]#webpage',
'url'  => 'https://www.uxpacific.com/ui-ux-design-agency-in-[slug]',
'name' => 'UI UX Design Agency in [Country] | UX Pacific',
'description' => 'Research-led UI/UX design agency serving [Country] businesses with UX research, usability testing, [COMPLIANCE LAW]-compliant product design, and design systems.',
'about' => ['@type' => 'Country', 'name' => '[Country]'],

// BreadcrumbList item 2:
'name' => '[Country]',
'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-[slug]',

// Service node:
'name'        => 'UI/UX Design Services in [Country]',
'areaServed'  => ['@type' => 'Country', 'name' => '[Country]'],
'serviceType' => 'UI UX Design, UX Research, Usability Testing, UX Audit, Product Discovery, Design Systems, [COMPLIANCE LAW]-Compliant UX',
'url'         => 'https://www.uxpacific.com/ui-ux-design-agency-in-[slug]',
```

**NEVER add `areaServed` to the Organization node.** The Organization `@id` is shared across all 5000 pages — adding a country there creates a Knowledge Graph contradiction.

`datePublished` and `dateModified` must both be `'2026-06-26'` (static, not `date('Y-m-d')`).

### 4 — `$hubChildren` array

List the states, provinces, regions, or territories for this country. Use the format:
```php
['name' => 'State Name', 'url' => '/ui-ux-design-agency-in-[state-slug]-[country-slug]']
```

State slugs: lowercase, hyphens for spaces, no special characters.

### 5 — Hero section

Change three things only:
- Badge text: `Research-Led UI UX Design Agency Serving [Country]`
- H1 second line: `IN [COUNTRY]` (uppercase)
- Subtext paragraph: Replace market context. Use country's dominant industries. E.g. for UK: "fintech, govtech, retail brands, NHS digital teams". For UAE: "fintech, proptech, government digital services, retail". Keep the same sentence structure.

### 6 — Breadcrumb nav

```html
<span>UI UX Design Agency in [Country]</span>
```

### 7 — Why Trust UX Pacific — Trust card 4

Change the compliance card title and body to match the country's primary law:
- Title: `[Law Name]-Aware Approach`
- Body: name the specific law and what it covers

### 8 — Services section

- **H2**: `UI/UX Design Services for [Country] Businesses`
- **Sub paragraph**: mention country-specific market conditions
- **Service 3** (compliance): Change law name, change description to match that law's UX implications
- **Service 6** (accessibility): Change accessibility law name and description

### 9 — Insight Framework

- **Step 2**: Change `German-speaking audiences` → `[Country]-specific audiences` or relevant detail
- **Step 5**: Change `German text, WCAG 2.1 AA, and GDPR-compliant interface patterns` → country-appropriate equivalent

### 10 — Deliverable cards (What You Receive)

- **UI Screens card**: Change `German text expansion, WCAG 2.1 AA` → country-specific equivalent (e.g. `French text expansion`, `RTL Arabic script`, `CCPA-compliant` etc.)
- **Interactive Prototype card**: If country has investor demo culture (US, UK, SG), keep `investor reviews`. Otherwise `stakeholder presentations`.

### 11 — Comparison table

- **Last row**: Replace `GDPR compliance and BITV 2.0 accessibility` / `DPDP Act 2023 compliance and RPWD accessibility` → country's laws

### 12 — UX Delivery Process

- **H2 sub-paragraph**: Change timezone reference. e.g. `GMT/BST` for UK, `EST/PST` for USA, `GST` for UAE, `AEST` for Australia.
- **Step 02**: Change `Indian market` → `[Country] market`
- **Step 05**: Change `Indian language requirements` → appropriate equivalent

### 13 — Expert Team cards

- **UX Research Lead**: Change `Indian product teams` → `[Country] product teams`
- **Senior Product Designer**: Change `Indian development team` → `[Country] development team`

### 14 — FAQs section heading

```html
<h2 class="de-h2">Frequently Asked Questions — UI/UX Design in [Country]</h2>
<p class="de-sub">Common questions from [describe local market, e.g. UK startups, enterprise teams, and scale-ups] exploring UI/UX design and user research services.</p>
```

### 15 — Hub section

```html
<h2 class="de-h2">UI/UX Design Services Across [Country]</h2>
<p class="de-sub">We serve businesses across every major [Country] [state/province/region]. Select your [state/region] to see how UX Pacific supports companies in your specific location.</p>
```

### 16 — CTA section

- **H2**: `Book a Free UX Audit for Your [Country] Product`
- **Step 2 body**: Change `GDPR compliance` / `DPDP compliance` → country's law abbreviation
- **City links paragraph**: List 5-6 major cities for this country. Each links to `/ui-ux-design-agency-in-[city-state-slug]-[country-slug]`
- **Audit modal phone placeholder**: Use country phone format (e.g. `+44 XXXX XXXXXX`, `+1 (XXX) XXX-XXXX`)

---

## Country Reference Table

Use this for the 7 priority countries. For any other country, derive the values using the rules above.

### United Kingdom

| Field | Value |
|---|---|
| Slug | `united-kingdom` |
| `$geoRegion` | `'GB'` |
| `$contentLanguage` | `'en-GB'` |
| `$ogLocale` | `'en_GB'` |
| Primary compliance law | UK GDPR + Data Protection Act 2018 |
| Compliance short name | `UK GDPR` |
| Accessibility law | Equality Act 2010, WCAG 2.1 AA, Public Sector Bodies Accessibility Regulations 2018 |
| Accessibility short name | `Equality Act / WCAG 2.1` |
| Currency + range | £3,500 to £40,000+ |
| Phone placeholder | `+44 XXXX XXXXXX` |
| Timezone | GMT / BST |
| Major cities (CTA links) | London, Manchester, Birmingham, Edinburgh, Bristol, Leeds |
| Market description | fintech, govtech, NHS digital teams, retail brands, SaaS scaleups |
| States/Regions hub label | `nations and regions` |
| Hub heading | `UI/UX Design Services Across the United Kingdom` |

UK hub children (use these slugs):
```php
['name' => 'England',          'url' => '/ui-ux-design-agency-in-england-united-kingdom'],
['name' => 'Scotland',         'url' => '/ui-ux-design-agency-in-scotland-united-kingdom'],
['name' => 'Wales',            'url' => '/ui-ux-design-agency-in-wales-united-kingdom'],
['name' => 'Northern Ireland', 'url' => '/ui-ux-design-agency-in-northern-ireland-united-kingdom'],
['name' => 'London',           'url' => '/ui-ux-design-agency-in-london-united-kingdom'],
['name' => 'Manchester',       'url' => '/ui-ux-design-agency-in-manchester-united-kingdom'],
['name' => 'Birmingham',       'url' => '/ui-ux-design-agency-in-birmingham-united-kingdom'],
['name' => 'Leeds',            'url' => '/ui-ux-design-agency-in-leeds-united-kingdom'],
['name' => 'Glasgow',          'url' => '/ui-ux-design-agency-in-glasgow-united-kingdom'],
['name' => 'Edinburgh',        'url' => '/ui-ux-design-agency-in-edinburgh-united-kingdom'],
['name' => 'Bristol',          'url' => '/ui-ux-design-agency-in-bristol-united-kingdom'],
['name' => 'Sheffield',        'url' => '/ui-ux-design-agency-in-sheffield-united-kingdom'],
['name' => 'Liverpool',        'url' => '/ui-ux-design-agency-in-liverpool-united-kingdom'],
['name' => 'Nottingham',       'url' => '/ui-ux-design-agency-in-nottingham-united-kingdom'],
['name' => 'Leicester',        'url' => '/ui-ux-design-agency-in-leicester-united-kingdom'],
['name' => 'Southampton',      'url' => '/ui-ux-design-agency-in-southampton-united-kingdom'],
['name' => 'Cambridge',        'url' => '/ui-ux-design-agency-in-cambridge-united-kingdom'],
['name' => 'Oxford',           'url' => '/ui-ux-design-agency-in-oxford-united-kingdom'],
['name' => 'Cardiff',          'url' => '/ui-ux-design-agency-in-cardiff-united-kingdom'],
['name' => 'Belfast',          'url' => '/ui-ux-design-agency-in-belfast-united-kingdom'],
['name' => 'Aberdeen',         'url' => '/ui-ux-design-agency-in-aberdeen-united-kingdom'],
```

---

### United States

| Field | Value |
|---|---|
| Slug | `united-states` |
| `$geoRegion` | `'US'` |
| `$contentLanguage` | `'en-US'` |
| `$ogLocale` | `'en_US'` |
| Primary compliance law | CCPA (California Consumer Privacy Act) + ADA |
| Compliance short name | `CCPA / ADA` |
| Accessibility law | Americans with Disabilities Act (ADA), Section 508, WCAG 2.1 AA |
| Accessibility short name | `ADA / Section 508` |
| Currency + range | $5,000 to $65,000+ |
| Phone placeholder | `+1 (XXX) XXX-XXXX` |
| Timezone | EST / PST / CST |
| Major cities (CTA links) | New York, San Francisco, Austin, Seattle, Chicago, Boston |
| Market description | SaaS platforms, healthtech, fintech, enterprise software, consumer apps |
| States hub label | `state` |
| Hub heading | `UI/UX Design Services Across the United States` |

US hub children (use these — top 21 by tech market size):
```php
['name' => 'California',     'url' => '/ui-ux-design-agency-in-california-united-states'],
['name' => 'Texas',          'url' => '/ui-ux-design-agency-in-texas-united-states'],
['name' => 'New York',       'url' => '/ui-ux-design-agency-in-new-york-united-states'],
['name' => 'Florida',        'url' => '/ui-ux-design-agency-in-florida-united-states'],
['name' => 'Illinois',       'url' => '/ui-ux-design-agency-in-illinois-united-states'],
['name' => 'Washington',     'url' => '/ui-ux-design-agency-in-washington-united-states'],
['name' => 'Massachusetts',  'url' => '/ui-ux-design-agency-in-massachusetts-united-states'],
['name' => 'Colorado',       'url' => '/ui-ux-design-agency-in-colorado-united-states'],
['name' => 'Georgia',        'url' => '/ui-ux-design-agency-in-georgia-united-states'],
['name' => 'North Carolina', 'url' => '/ui-ux-design-agency-in-north-carolina-united-states'],
['name' => 'Michigan',       'url' => '/ui-ux-design-agency-in-michigan-united-states'],
['name' => 'Pennsylvania',   'url' => '/ui-ux-design-agency-in-pennsylvania-united-states'],
['name' => 'Ohio',           'url' => '/ui-ux-design-agency-in-ohio-united-states'],
['name' => 'Arizona',        'url' => '/ui-ux-design-agency-in-arizona-united-states'],
['name' => 'Virginia',       'url' => '/ui-ux-design-agency-in-virginia-united-states'],
['name' => 'Tennessee',      'url' => '/ui-ux-design-agency-in-tennessee-united-states'],
['name' => 'Oregon',         'url' => '/ui-ux-design-agency-in-oregon-united-states'],
['name' => 'Minnesota',      'url' => '/ui-ux-design-agency-in-minnesota-united-states'],
['name' => 'Maryland',       'url' => '/ui-ux-design-agency-in-maryland-united-states'],
['name' => 'Nevada',         'url' => '/ui-ux-design-agency-in-nevada-united-states'],
['name' => 'Indiana',        'url' => '/ui-ux-design-agency-in-indiana-united-states'],
```

---

### United Arab Emirates

| Field | Value |
|---|---|
| Slug | `uae` |
| `$geoRegion` | `'AE'` |
| `$contentLanguage` | `'en-AE'` |
| `$ogLocale` | `'en_AE'` |
| Primary compliance law | UAE Personal Data Protection Law (PDPL — Federal Decree-Law No. 45 of 2021) |
| Compliance short name | `UAE PDPL` |
| Accessibility law | UAE Web Accessibility Standards, WCAG 2.1 AA |
| Accessibility short name | `UAE Web Accessibility Standards / WCAG 2.1` |
| Currency + range | AED 18,000 to AED 200,000+ |
| Phone placeholder | `+971 XX XXX XXXX` |
| Timezone | GST (UTC+4) |
| Major cities (CTA links) | Dubai, Abu Dhabi, Sharjah, Ajman |
| Market description | fintech, proptech, government digital services, retail and luxury e-commerce |
| Special note | UAE has Arabic as official language — mention RTL Arabic script as a design consideration in FAQ 3 and Framework Step 5 |
| States hub label | `emirate` |
| Hub heading | `UI/UX Design Services Across the UAE` |

UAE hub children:
```php
['name' => 'Dubai',          'url' => '/ui-ux-design-agency-in-dubai-uae'],
['name' => 'Abu Dhabi',      'url' => '/ui-ux-design-agency-in-abu-dhabi-uae'],
['name' => 'Sharjah',        'url' => '/ui-ux-design-agency-in-sharjah-uae'],
['name' => 'Ajman',          'url' => '/ui-ux-design-agency-in-ajman-uae'],
['name' => 'Ras Al Khaimah', 'url' => '/ui-ux-design-agency-in-ras-al-khaimah-uae'],
['name' => 'Fujairah',       'url' => '/ui-ux-design-agency-in-fujairah-uae'],
['name' => 'Umm Al-Quwain',  'url' => '/ui-ux-design-agency-in-umm-al-quwain-uae'],
```

---

### Australia

| Field | Value |
|---|---|
| Slug | `australia` |
| `$geoRegion` | `'AU'` |
| `$contentLanguage` | `'en-AU'` |
| `$ogLocale` | `'en_AU'` |
| Primary compliance law | Privacy Act 1988 (Australian Privacy Principles — APPs) |
| Compliance short name | `Privacy Act / APPs` |
| Accessibility law | Disability Discrimination Act 1992, WCAG 2.1 AA |
| Accessibility short name | `DDA / WCAG 2.1` |
| Currency + range | AUD $6,000 to AUD $70,000+ |
| Phone placeholder | `+61 X XXXX XXXX` |
| Timezone | AEST / AEDT / AWST |
| Major cities (CTA links) | Sydney, Melbourne, Brisbane, Perth, Adelaide, Canberra |
| Market description | fintech, govtech, edtech, agritech, mining technology, health services |
| States hub label | `state or territory` |
| Hub heading | `UI/UX Design Services Across Australia` |

Australia hub children:
```php
['name' => 'New South Wales',              'url' => '/ui-ux-design-agency-in-new-south-wales-australia'],
['name' => 'Victoria',                     'url' => '/ui-ux-design-agency-in-victoria-australia'],
['name' => 'Queensland',                   'url' => '/ui-ux-design-agency-in-queensland-australia'],
['name' => 'Western Australia',            'url' => '/ui-ux-design-agency-in-western-australia-australia'],
['name' => 'South Australia',              'url' => '/ui-ux-design-agency-in-south-australia-australia'],
['name' => 'Tasmania',                     'url' => '/ui-ux-design-agency-in-tasmania-australia'],
['name' => 'Northern Territory',           'url' => '/ui-ux-design-agency-in-northern-territory-australia'],
['name' => 'Australian Capital Territory', 'url' => '/ui-ux-design-agency-in-australian-capital-territory-australia'],
```

---

### Canada

| Field | Value |
|---|---|
| Slug | `canada` |
| `$geoRegion` | `'CA'` |
| `$contentLanguage` | `'en-CA'` |
| `$ogLocale` | `'en_CA'` |
| Primary compliance law | PIPEDA (Personal Information Protection and Electronic Documents Act) |
| Compliance short name | `PIPEDA` |
| Accessibility law | Accessible Canada Act (ACA), WCAG 2.1 AA |
| Accessibility short name | `Accessible Canada Act / WCAG 2.1` |
| Currency + range | CAD $6,500 to CAD $70,000+ |
| Phone placeholder | `+1 (XXX) XXX-XXXX` |
| Timezone | EST / PST / CST |
| Major cities (CTA links) | Toronto, Vancouver, Montreal, Calgary, Ottawa, Edmonton |
| Market description | fintech, healthtech, SaaS, govtech, AI/ML startups |
| Special note | Canada is bilingual — mention French-Canadian (Quebec) as a multilingual design consideration in FAQ 3 |
| States hub label | `province or territory` |
| Hub heading | `UI/UX Design Services Across Canada` |

Canada hub children:
```php
['name' => 'Ontario',                    'url' => '/ui-ux-design-agency-in-ontario-canada'],
['name' => 'British Columbia',           'url' => '/ui-ux-design-agency-in-british-columbia-canada'],
['name' => 'Quebec',                     'url' => '/ui-ux-design-agency-in-quebec-canada'],
['name' => 'Alberta',                    'url' => '/ui-ux-design-agency-in-alberta-canada'],
['name' => 'Manitoba',                   'url' => '/ui-ux-design-agency-in-manitoba-canada'],
['name' => 'Saskatchewan',               'url' => '/ui-ux-design-agency-in-saskatchewan-canada'],
['name' => 'Nova Scotia',                'url' => '/ui-ux-design-agency-in-nova-scotia-canada'],
['name' => 'New Brunswick',              'url' => '/ui-ux-design-agency-in-new-brunswick-canada'],
['name' => 'Newfoundland and Labrador',  'url' => '/ui-ux-design-agency-in-newfoundland-and-labrador-canada'],
['name' => 'Prince Edward Island',       'url' => '/ui-ux-design-agency-in-prince-edward-island-canada'],
['name' => 'Northwest Territories',      'url' => '/ui-ux-design-agency-in-northwest-territories-canada'],
['name' => 'Yukon',                      'url' => '/ui-ux-design-agency-in-yukon-canada'],
['name' => 'Nunavut',                    'url' => '/ui-ux-design-agency-in-nunavut-canada'],
```

---

### Singapore

| Field | Value |
|---|---|
| Slug | `singapore` |
| `$geoRegion` | `'SG'` |
| `$contentLanguage` | `'en-SG'` |
| `$ogLocale` | `'en_SG'` |
| Primary compliance law | Personal Data Protection Act 2012 (PDPA) |
| Compliance short name | `PDPA` |
| Accessibility law | Digital Service Standards (DSS), WCAG 2.1 AA |
| Accessibility short name | `DSS / WCAG 2.1` |
| Currency + range | SGD $7,000 to SGD $75,000+ |
| Phone placeholder | `+65 XXXX XXXX` |
| Timezone | SGT (UTC+8) |
| Major cities (CTA links) | Singapore is a city-state — use districts/planning areas: Central Business District, Orchard, Jurong, Tampines, Woodlands |
| Market description | fintech, govtech (Smart Nation initiative), logistics technology, wealth management, insurtech |
| Special note | Singapore is a city-state — the hub grid should use industry sectors or planning regions instead of states. Use Singapore's 5 regions as hub children. |
| Hub heading | `UI/UX Design Services Across Singapore` |

Singapore hub children (5 planning regions):
```php
['name' => 'Central Region',    'url' => '/ui-ux-design-agency-in-central-region-singapore'],
['name' => 'North Region',      'url' => '/ui-ux-design-agency-in-north-region-singapore'],
['name' => 'North-East Region', 'url' => '/ui-ux-design-agency-in-north-east-region-singapore'],
['name' => 'East Region',       'url' => '/ui-ux-design-agency-in-east-region-singapore'],
['name' => 'West Region',       'url' => '/ui-ux-design-agency-in-west-region-singapore'],
```

---

### France

| Field | Value |
|---|---|
| Slug | `france` |
| `$geoRegion` | `'FR'` |
| `$contentLanguage` | `'en-FR'` |
| `$ogLocale` | `'en_FR'` |
| Primary compliance law | GDPR + CNIL regulations |
| Compliance short name | `GDPR / CNIL` |
| Accessibility law | RGAA (Référentiel Général d'Amélioration de l'Accessibilité), WCAG 2.1 AA |
| Accessibility short name | `RGAA / WCAG 2.1` |
| Currency + range | €4,500 to €50,000+ |
| Phone placeholder | `+33 X XX XX XX XX` |
| Timezone | CET / CEST |
| Major cities (CTA links) | Paris, Lyon, Marseille, Toulouse, Bordeaux, Nantes |
| Market description | luxury digital experiences, retail and e-commerce, fintech, govtech, enterprise SaaS |
| Special note | French text runs ~20% longer than English — same consideration as German. Mention this in FAQ 3 and Framework Step 5. |
| States hub label | `region` |
| Hub heading | `UI/UX Design Services Across France` |

France hub children (13 metropolitan regions + overseas):
```php
['name' => 'Île-de-France',                    'url' => '/ui-ux-design-agency-in-ile-de-france-france'],
['name' => 'Auvergne-Rhône-Alpes',             'url' => '/ui-ux-design-agency-in-auvergne-rhone-alpes-france'],
['name' => 'Provence-Alpes-Côte d\'Azur',      'url' => '/ui-ux-design-agency-in-provence-alpes-cote-dazur-france'],
['name' => 'Occitanie',                        'url' => '/ui-ux-design-agency-in-occitanie-france'],
['name' => 'Nouvelle-Aquitaine',               'url' => '/ui-ux-design-agency-in-nouvelle-aquitaine-france'],
['name' => 'Hauts-de-France',                  'url' => '/ui-ux-design-agency-in-hauts-de-france-france'],
['name' => 'Grand Est',                        'url' => '/ui-ux-design-agency-in-grand-est-france'],
['name' => 'Pays de la Loire',                 'url' => '/ui-ux-design-agency-in-pays-de-la-loire-france'],
['name' => 'Bretagne',                         'url' => '/ui-ux-design-agency-in-bretagne-france'],
['name' => 'Normandie',                        'url' => '/ui-ux-design-agency-in-normandie-france'],
['name' => 'Bourgogne-Franche-Comté',          'url' => '/ui-ux-design-agency-in-bourgogne-franche-comte-france'],
['name' => 'Centre-Val de Loire',              'url' => '/ui-ux-design-agency-in-centre-val-de-loire-france'],
['name' => 'Corse',                            'url' => '/ui-ux-design-agency-in-corse-france'],
```

---

## Sitemap Entry (add to sitemap-core.xml)

After creating the file, add this entry to `C:\xampp\htdocs\UX_Pacific\sitemap-core.xml` using the Edit tool. Insert before the closing `</urlset>` tag.

```xml
  <url>
    <loc>https://www.uxpacific.com/ui-ux-design-agency-in-[slug]</loc>
    <lastmod>2026-06-26</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
```

---

## Quality Checklist

Before reporting the task as done, verify all of the following:

- [ ] File created at correct path: `C:\xampp\htdocs\UX_Pacific\ui-ux-design-agency-in-[slug].php`
- [ ] `$countrySlug`, `$geoRegion`, `$geoCountry`, `$contentLanguage`, `$ogLocale` all set correctly
- [ ] `$canonicalUrl` and schema `url`/`@id` all use the same slug
- [ ] `$pageDesc` is under 160 characters
- [ ] `$ogDesc` is under 160 characters
- [ ] FAQs: exactly 10 questions, all country-specific, no Germany/India references remain
- [ ] Schema: `areaServed` present on Service node, NOT on Organization node
- [ ] Schema: `datePublished` and `dateModified` are static `'2026-06-26'`, not `date('Y-m-d')`
- [ ] Schema: `inLanguage` is `'en'` (not `'en-GB'` or `'en-US'`)
- [ ] `$hubChildren` array uses correct country slug suffix on every URL
- [ ] Hero badge, H1, subtext updated for this country
- [ ] Trust card 4: shows correct compliance law name
- [ ] Service 3: shows correct compliance law
- [ ] Service 6: shows correct accessibility law
- [ ] Comparison table last row: shows correct laws
- [ ] Framework step 2 and 5: country-appropriate references
- [ ] CTA section: correct law name in Step 2, correct city links, correct phone placeholder
- [ ] Breadcrumb text matches country name
- [ ] No leftover references to "Germany", "India", "GDPR" (unless country uses GDPR, like France), "DPDP", "German", "Indian", "+49", "+91"
- [ ] Inline `<style>` block is complete (`.de-*` CSS) — do not shorten it
- [ ] Audit modal JS block is complete — do not shorten it
- [ ] Sitemap entry added to `sitemap-core.xml`
- [ ] PHP syntax is valid: no unclosed arrays, no missing semicolons, no quote escaping errors

---

## Notes on Content Quality

- Do not thin out content. Every section must be fully populated.
- Do not copy-paste compliance law names carelessly — each country has a specific name and year.
- Keep all 10 FAQ answers at 2-4 sentences minimum.
- The inline `<style>` block is identical across all pages — copy it exactly. Do not trim it.
- The audit modal and success popup JS block is identical across all pages — copy it exactly.
- The Organization schema block is identical across all pages — copy it exactly, never add `areaServed`.
- `$metaAuthor` is always `'UXPACIFIC'`.
- `$metaRobots` is always `'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'`.
- `$themeColor` is always `'#080808'`.
- `$currentPage` is always `''`.
