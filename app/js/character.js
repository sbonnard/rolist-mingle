const MODAL_CONFIGS = {
  'health-bar': {
    title: 'PV',
    fields: [
      { id: 'pv-current', label: 'Actuels', attr: 'health-bar' },
      { id: 'pv-max',     label: 'Max',     attr: 'health-bar' },
    ]
  },
  'mana-bar': {
    title: 'Mana',
    fields: [
      { id: 'mana-current', label: 'Actuel', attr: 'mana-bar' },
      { id: 'mana-max',     label: 'Max',    attr: 'mana-bar' },
    ]
  },
  gold:   { title: "Or",     fields: [{ id: 'gold',   label: "Or",     attr: 'gold'   }] },
  silver: { title: "Argent", fields: [{ id: 'silver', label: "Argent", attr: 'silver' }] },
  copper: { title: "Cuivre", fields: [{ id: 'copper', label: "Cuivre", attr: 'copper' }] },
};

const DATA_KEYS = Object.keys(MODAL_CONFIGS);
let currentTarget = null;

function getAttrKey(el) {
  return DATA_KEYS.find(key => el.dataset[key] !== undefined) ?? null;
}

function openDrawer(el, key) {
  currentTarget = el;
  const cfg = MODAL_CONFIGS[key];

  document.getElementById('drawer-title').textContent = 'Modifier ' + cfg.title;

  const fieldsEl = document.getElementById('drawer-fields');
  fieldsEl.innerHTML = '';
  cfg.fields.forEach(f => {
    fieldsEl.insertAdjacentHTML('beforeend', `
      <div class="drawer-row">
        <label for="${f.id}">${f.label}</label>
        <input id="${f.id}" type="number" value="${el.dataset[f.attr] ?? ''}">
      </div>
    `);
  });

  document.getElementById('drawer-overlay').classList.add('open');
  fieldsEl.querySelector('input')?.focus();
}

function closeDrawer() {
  document.getElementById('drawer-overlay').classList.remove('open');
  currentTarget = null;
}

document.getElementById('drawer-overlay').addEventListener('click', e => {
  if (e.target.id === 'drawer-overlay') closeDrawer();
});

document.getElementById('drawer-cancel').addEventListener('click', closeDrawer);

document.getElementById('drawer-confirm').addEventListener('click', () => {
  if (!currentTarget) return;
  const key = getAttrKey(currentTarget);
  MODAL_CONFIGS[key].fields.forEach(f => {
    const val = document.getElementById(f.id)?.value;
    if (val !== undefined) {
      currentTarget.dataset[f.attr] = val;
      // 👉 Mets à jour ton DOM ici si besoin
    }
  });
  closeDrawer();
});

document.querySelectorAll(DATA_KEYS.map(k => `[data-${k}]`).join(', '))
  .forEach(el => {
    el.style.cursor = 'pointer';
    el.addEventListener('click', () => {
      const key = getAttrKey(el);
      if (key) openDrawer(el, key);
    });
  });