В этот раз нам нужна бд - поэтому заводимся через докер) При необходимости поправить параметры под себя.

1. При попытке получить список авторов (GET /authors/) получаем ошибку. Почему и как исправить?
2. Проверить метод создания автора POST /authors/ - что с ним не так и как это исправить? P.S. Репозиторий использовать нельзя =)
3. Проверить метод созданий серии POST /series/ - что с ним не так и как это исправить? Внедрять новые классы нельзя - работаем с тем, что есть. P.S. А вот тут надо сделать через репозиторий
4. Проверить метод GET /books/filters/authors/{authorId}/ - почему он не работает и как это исправить? P.S. Здесь знакомимся с queryBuilder - решаем через него
5. Проверить метод GET /books/filters/pages/{pageCount}/ - почему он не работает и как это исправить? P.S. Здесь знакомимся с DQL - решаем через него
6. Проверить метод GET /books/filters/authors/{authorId}/pages/{pageCount}/ - почему он не работает и как это исправить? P.S. Здесь знакомимся с NativeQuery - решаем через него
7. Проверить метод GET /books/filters/series/{seriesId}/ - почему он не работает и как это исправить? P.S. Здесь знакомимся с PDO - решаем через него.
8. После исправления в пункте 7 все ок, но в ответе летят дубликаты. Почему и как это исправить? 
9. Создай новую сущность-справочник "Жанр", свяжи её с Book. Сделай миграцию и проинициализируй новую таблицу несколькими значениями. Сделай для новой сущности контроллер с одним методом - получение всего списка.

Доп. задание "со звёздочкой": все ли нормально с ответом метода GET /books/filters/authors/{authorId}/pages/{pageCount}/?..