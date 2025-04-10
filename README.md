=== SmartTalk WP AI ===
Contributors: Fabrizio Padula
Tags: ai chatbot, openrouter, openchat, wordpress chatbot, intent detection  
Requires at least: 5.8  
Tested up to: 6.7  
Requires PHP: 7.4  
Stable tag: 1.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

SmartTalk WP AI è un chatbot intelligente basato su AI, integrato come widget fisso nel sito WordPress. Riconosce gli intenti degli utenti e fornisce risposte utili in base ai contenuti reali del sito.

== Description ==

**SmartTalk WP AI** è un plugin AI-ready per WordPress che permette di installare in pochi clic un chatbot fisso sul sito.  
Interagisce con gli utenti, comprende le loro domande e propone risposte reali (es. "Dove trovo i contatti?", "Qual è il numero di telefono?").

Caratteristiche principali:
- Riconoscimento degli intenti con AI
- Integrazione via API (gratuita, OpenRouter)
- Interfaccia moderna con Tailwind CSS
- Widget fisso visibile su tutte le pagine
- Pannello opzioni nella sidebar di WordPress
- Possibilità di scegliere il modello AI preferito

== Installation ==

1. Scarica il plugin in formato `.zip`
2. Vai su **Plugin > Aggiungi nuovo > Carica plugin**
3. Carica e installa il file `smarttalk-wp-ai.zip`
4. Attiva il plugin
5. Vai su **Impostazioni > SmartTalk AI** nella sidebar di WordPress

== Setup API Key ==

⚠️ Per far funzionare il chatbot, serve una chiave API gratuita da [OpenRouter.ai](https://openrouter.ai/).

### Passaggi:

1. Vai su https://openrouter.ai
2. Clicca su “Sign in with Google/GitHub” e accedi
3. Vai su “API Keys” dal tuo profilo
4. Clicca su **Create key** e copia la chiave generata

Torna su WordPress:

5. Vai in **Impostazioni > SmartTalk AI**
6. Inserisci la chiave API nel campo “OpenRouter API Key”
7. Seleziona il modello AI (es. `openchat/openchat`)
8. Salva le impostazioni 

== Frequently Asked Questions ==

= Posso usare modelli diversi da openchat/openchat? =
Sì. SmartTalk WP AI ti permette di scegliere tra tre modelli:
- openchat/openchat
- mistralai/mistral-7b
- nousresearch/nous-capybara

= Dove viene mostrato il chatbot? =
Il chatbot è un widget fisso in basso a destra, presente su tutte le pagine del sito, se abilitato.

= Quanto costa l’utilizzo dell’API? =
L’utilizzo di OpenRouter è gratuito, ma soggetto a limiti del provider. Consulta i dettagli su openrouter.ai.

== Screenshots ==

1. Il chatbot visibile sul sito frontend
2. Pannello opzioni nella dashboard di WordPress
3. Esempio di conversazione intelligente

== Changelog ==

= 1.0 =
* Primo rilascio stabile
* Integrazione con OpenRouter API
* Interfaccia impostazioni nella dashboard
* Widget fisso attivabile/disattivabile

== Upgrade Notice ==

= 1.0 =
Prima release stabile. Inserisci la tua API key per iniziare.

== Credits ==
Creato con ❤️ da Fabrizio Padula 

== License ==
GPLv2 or later