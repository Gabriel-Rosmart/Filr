# FILR

## **Project Setup**

**Clone the repository:**

```
git clone https://github.com/Gabriel-Rosmart/Filr.git
```

**Change directory:**

```
cd Filr
```

**Install composer dependencies:**

```
composer install
```

**Install npm dependencies:**
```
npm install
```

**Copy enviroment file:**

Windows (cmd):

```
copy .env.example .env
```

Linux:

```
cp .env.example .env
```

**Chage the following code in .env file:**

```
DB_USERNAME=root
DB_PASSWORD=
```

**And put your credentials:**

```
DB_USERNAME=my-db-username
DB_PASSWORD=my-db-password
```

**Generate an app key:**

```
php artisan key:generate --ansi
```

**Make sure the .env file has now a key:**
> This example is not a real key
```
APP_KEY=base64-encoded-key
```

**Check if project runs properly (optional):**

```
npm run dev
```
```
php artisan serve
```

> Go to http://localhost:8000

**Build project (only before project is ready for deployment):**

```
npm run build
```

And that's it, you now have your project ready to run