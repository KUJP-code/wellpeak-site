(function () {
  function setError(el, msg) {
    const field = el.closest(".field, .consent");
    if (!field) return;
    const err = field.querySelector(".error");
    el.setAttribute("aria-invalid", "true");
    if (err) err.textContent = msg || "";
  }
  function clearError(el) {
    const field = el.closest(".field, .consent");
    if (!field) return;
    const err = field.querySelector(".error");
    el.removeAttribute("aria-invalid");
    if (err) err.textContent = "";
  }
  const emailOK = (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  const phoneOK = (v) => !v || /^[0-9+\-\s()]{8,20}$/.test(v);

  document.addEventListener("submit", async function (e) {
    const form = e.target.closest(".inquiry-form");
    if (!form) return;
    e.preventDefault();

    const school = form.querySelector("#school");
    const gname = form.querySelector("#guardian_name");
    const email = form.querySelector("#email");
    const phone = form.querySelector("#phone");
    const consent = form.querySelector("#consent");

    form.querySelectorAll('[aria-invalid="true"]').forEach(clearError);

    let ok = true;
    if (!school.value) {
      setError(school, "スクールを選択してください。");
      ok = false;
    }
    if (!gname.value.trim()) {
      setError(gname, "保護者のお名前は必須です。");
      ok = false;
    }
    if (!email.value.trim()) {
      setError(email, "メールアドレスは必須です。");
      ok = false;
    } else if (!emailOK(email.value.trim())) {
      setError(email, "メールアドレスの形式が正しくありません。");
      ok = false;
    }
    if (phone && phone.value && !phoneOK(phone.value.trim())) {
      setError(phone, "電話番号の形式が正しくありません。");
      ok = false;
    }
    if (!consent.checked) {
      setError(consent, "同意が必要です。");
      ok = false;
    }

    const status = form.querySelector(".form-status");
    if (!ok) {
      if (status) status.textContent = "未入力または不正な項目があります。";
      return;
    }
    if (status) status.textContent = "送信中…";

    const fd = new FormData(form);
    fd.append("action", "wellpeak_submit_inquiry");
    fd.append("nonce", (window.WellpeakInquiry && WellpeakInquiry.nonce) || "");

    try {
      const res = await fetch(
        (window.WellpeakInquiry && WellpeakInquiry.ajax_url) ||
          "/wp-admin/admin-ajax.php",
        {
          method: "POST",
          body: fd,
          credentials: "same-origin",
        },
      );
      const json = await res.json();

      if (!json.success) {
        if (json.data && json.data.errors) {
          Object.entries(json.data.errors).forEach(([key, msg]) => {
            const el = form.querySelector(`#${key}`);
            if (el) setError(el, msg);
          });
          if (status) status.textContent = "未入力または不正な項目があります。";
        } else {
          if (status)
            status.textContent = "送信に失敗しました。もう一度お試しください。";
        }
        return;
      }

      if (status) status.textContent = "送信しました。ありがとうございました。";
      form.reset();
    } catch (err) {
      if (status)
        status.textContent =
          "通信に失敗しました。ネットワークをご確認ください。";
    }
  });
})();
