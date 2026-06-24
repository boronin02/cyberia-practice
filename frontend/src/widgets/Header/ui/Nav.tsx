import styles from "./Header.module.css";

export const Nav = () => {
  return (
    <>
      <nav>
        <ul className={styles.list}>
          <li>Проекты</li>
          <li>Услуги</li>
          <li>О компании</li>
          <li>Карьера</li>
          <li>Блог</li>
          <li>Новости</li>
          <li>Контакты</li>
        </ul>
      </nav>
    </>
  );
};
