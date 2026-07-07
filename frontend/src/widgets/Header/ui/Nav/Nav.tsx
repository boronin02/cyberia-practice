import styles from "./Nav.module.scss";
import Link from "next/link";
import { ROUTES } from "@/shared/index";

export const Nav = () => {
  return (
    <nav className={styles.nav}>
      <ul className={styles.list}>
        <Link href={ROUTES.PROJECTS}>
          <li>Проекты</li>
        </Link>
        <li>Услуги</li>
        <li>О компании</li>
        <li>Карьера</li>
        <li>Блог</li>
        <li>Новости</li>
        <li>Контакты</li>
      </ul>
    </nav>
  );
};
