import styles from "./MobileMenu.module.scss";
import Image from "next/image";
import {
  logoWhite,
  closeBurger,
  tgLogoWhite,
  maxLogoWhite,
  vkLogoWhite,
} from "@/shared/assets/images/header";

interface MobileMenuProps {
  isOpen: boolean;
  closeMenu: () => void;
}

export const MobileMenu = ({ isOpen, closeMenu }: MobileMenuProps) => {
  return (
    <>
      <div className={`${styles.mobileMenu} ${isOpen ? styles.open : ""}`}>
        <div className={styles.header}>
          <Image src={logoWhite} alt="logo" />
          <Image
            src={closeBurger}
            alt="closeBurger"
            onClick={closeMenu}
            style={{ cursor: "pointer" }}
          />
        </div>
        <nav className={styles.nav}>
          <ul className={styles.list}>
            <li onClick={closeMenu}>Проекты</li>
            <li onClick={closeMenu}>Услуги</li>
            <li onClick={closeMenu}>О компании</li>
            <li onClick={closeMenu}>Карьера</li>
            <li onClick={closeMenu}>Блог</li>
            <li onClick={closeMenu}>Новости</li>
            <li onClick={closeMenu}>Контакты</li>
          </ul>
        </nav>
        <div className={styles.link}>
          <div className={styles.number}>+7 960 959 18 66</div>
          <div className={styles.mail}>hello@cyberia.studio</div>
          <div className={styles.socials}>
            <Image src={tgLogoWhite} alt="tgLogoWhite" />
            <Image src={maxLogoWhite} alt="maxLogoWhite" />
            <Image src={vkLogoWhite} alt="vkLogoWhite" />
          </div>
        </div>
        <div className={styles.button}>
          <span>Обсудить проект</span>
        </div>
      </div>
    </>
  );
};
