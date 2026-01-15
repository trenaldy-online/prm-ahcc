(function(window, document) {
    const scriptTag = document.getElementById('ahcc-tracker-script');
    const apiUrl = scriptTag.getAttribute('data-endpoint');
    
    if (!apiUrl) return;

    function initTracking() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentSearchString = window.location.search; 

        // 1. Ambil Parameter Iklan
        const gclid = urlParams.get('gclid');
        const fbclid = urlParams.get('fbclid');
        
        let utm_source = urlParams.get('utm_source');
        let utm_medium = urlParams.get('utm_medium');
        let utm_campaign = urlParams.get('utm_campaign');

        // --- LOGIKA CERDAS: AUTO-DETECT GOOGLE & FB ---
        // Jika UTM kosong tapi ada GCLID, berarti dari Google Ads
        if (gclid && !utm_source) {
            utm_source = 'google';
            utm_medium = 'cpc'; // Cost Per Click
        }
        // Jika UTM kosong tapi ada FBCLID, berarti dari Facebook Organic/Ads
        else if (fbclid && !utm_source) {
            utm_source = 'facebook';
            utm_medium = 'social';
        }
        // ------------------------------------------------

        const hasCampaignParams = gclid || fbclid || utm_source;
        
        const storedCode = localStorage.getItem('ahcc_ref_code');
        const lastSearchString = localStorage.getItem('ahcc_last_search'); 

        // Cek apakah ini kunjungan baru yang valid
        const isRealNewCampaign = hasCampaignParams && (currentSearchString !== lastSearchString);

        if (isRealNewCampaign || !storedCode) {
            
            console.log("AHCC Tracker: Requesting NEW Session...");
            
            const payload = {
                landing_page: window.location.href,
                referrer: document.referrer,
                ref_code: urlParams.get('ref_code'),
                gclid: gclid,
                fbclid: fbclid,
                // Kirim hasil deteksi cerdas tadi
                utm_source: utm_source, 
                utm_medium: utm_medium,
                utm_campaign: utm_campaign,
                utm_term: urlParams.get('utm_term'),
                utm_content: urlParams.get('utm_content')
            };

            fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                credentials: 'include',
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if(data.ref_code) {
                    localStorage.setItem('ahcc_ref_code', data.ref_code);
                    localStorage.setItem('ahcc_last_search', currentSearchString);
                    updatePageElements(data.ref_code);
                }
            })
            .catch(error => console.error('AHCC Tracker Error:', error));
            
        } else {
            console.log("AHCC Tracker: Using existing session.");
            if(storedCode) updatePageElements(storedCode);
        }
    }

    function updatePageElements(code) {
        // Link WA
        const waLinks = document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"]');
        waLinks.forEach(link => {
            try {
                let currentUrl = new URL(link.href);
                let params = new URLSearchParams(currentUrl.search);
                let existingText = params.get('text') || "Halo Admin, saya tertarik dengan layanan AHCC.";
                if(!existingText.includes('(Ref:')) {
                    params.set('text', `${existingText}\n\n(Ref: ${code})`);
                    link.href = `${currentUrl.origin}${currentUrl.pathname}?${params.toString()}`;
                }
            } catch (e) {}
        });

        // Hidden Input
        const hiddenInputs = document.querySelectorAll('input[name="ref_code"]');
        hiddenInputs.forEach(input => input.value = code);
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initTracking);
    } else {
        initTracking();
    }

})(window, document);