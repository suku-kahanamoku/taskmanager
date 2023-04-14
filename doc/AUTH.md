# MeisterTask

## Pro autorizaci k API MeisterTask, postupujte následovně:
**Jsou 3 způsoby autorizace**
1. Authorization Code Flow
    Uživatel se nejprve přihlašuje na autorizační server MindMeisteru, který poskytuje přístupový kód (authorization code). Tento kód uživatel poté použije k získání přístupového tokenu (access token) přes další žádost na server MindMeisteru. Tento tokenu bude použit v dalších interakcích s MindMeister API.
2. Implicit Flow
    Vrací přístupový token přímo v odpovědi na autorizační požadavek, takže není vyžadován další požadavek na server MindMeisteru. Tento tokenu se obvykle používá pro klienty s webovými aplikacemi nebo aplikacemi pro mobilní zařízení, které nemohou bezpečně uchovávat tajné kódy, jako je přístupový kód.
3. Nahrát access_token z API https://www.mindmeister.com/api


### Authorization Code Flow

1. Zaregistrujte se na stránce https://developers.meistertask.com/ a vytvořte si novou aplikaci.

2. Získáte klíč API a tajný klíč pro přístup k API. Tyto klíče jsou důležité pro komunikaci s API MeisterTask.

3. Aby bylo možné přistupovat k API MeisterTask, je nutné nejprve získat přístupový token. K získání přístupového tokenu je potřeba provést autorizační proces OAuth 2.0.

4. Pro zahájení OAuth autorizace, musíte v prohlížeči otevřit následující URL:

```bash
https://www.mindmeister.com/oauth2/authorize?
response_type=code&
client_id=<apiId>&
redirect_uri=<redirUrl>
```

5. Uživatel bude po odeslání GET požadavku přesměrován na stránku pro přihlášení na MeisterTask. Pokud uživatel přihlášení úspěšně dokončí, bude přesměrován na adresa URL, kterou jste určili v předchozím kroku. V této adrese bude obsažen autorizační kód.

6. Nyní musíte odeslat POST požadavek na následující URL, abyste získali přístupový token:

```bash
https://www.mindmeister.com/oauth2/token?
grant_type=authorization_code&
code=<code>&
client_id=<apiId>&
client_secret=<secret>&
redirect_uri=<redirUrl>
```

7. Odpovědí na váš POST požadavek bude JSON objekt obsahující přístupový token. Tento token můžete nyní použít k přístupu k API MeisterTask.


### Implicit Flow

1. Zaregistrujte se na stránce https://developers.meistertask.com/ a vytvořte si novou aplikaci.

2. Získáte klíč API a tajný klíč pro přístup k API. Tyto klíče jsou důležité pro komunikaci s API MeisterTask.

3. Aby bylo možné přistupovat k API MeisterTask, je nutné nejprve získat přístupový token. K získání přístupového tokenu je potřeba provést autorizační proces OAuth 2.0.

4. Pro zahájení OAuth autorizace, musíte odeslat POST požadavek na následující URL:

```bash
https://www.mindmeister.com/oauth2/token

grant_type=client_credentials
client_id=<apiId>
client_secret=<secret>
```

5. Odpovědí na váš POST požadavek bude JSON objekt obsahující přístupový token. Tento token můžete nyní použít k přístupu k API MeisterTask.