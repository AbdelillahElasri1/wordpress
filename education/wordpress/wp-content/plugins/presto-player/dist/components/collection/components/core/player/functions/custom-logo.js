export default o=>{o.on("ready",(()=>{o?.config?.logo&&!o?.config?.logo_added&&"undefined"!=typeof jQuery&&(o.isAudio||(jQuery(`<img src="${o?.config?.logo}" class="presto-player__logo is-bottom-right" part="logo">`).insertBefore(o?.elements?.controls),o.config.logo_added=!0))}))};