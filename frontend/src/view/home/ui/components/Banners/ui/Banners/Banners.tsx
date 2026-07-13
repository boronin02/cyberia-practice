import Image from "next/image";
import styles from "./Banners.module.scss";
import { people, bgPatch } from "@/shared/assets/images/banners";
import { Arrow, MaxIcon, TgIcon, VkIcon } from "@/shared/assets/icons";

export const Banners = () => {
  return (
    <section className={styles.banners}>
      <div className={styles.left}>
        <Image src={people} alt="people" width={420} height={315} />
      </div>
      <div className={styles.right}>
        <div className={styles.title}>Обсудим ваш проект?</div>
        <div className={styles.subtitle}>
          Сформируем четкий план реализации проекта в кратчайшие сроки и в рамках вашего бюджета
        </div>
        <div className={styles.callToAction}>
          <div className={styles.text}>Обсудить проект</div>
          <div className={styles.socials}>
            <TgIcon />
            <MaxIcon />
            <VkIcon />
          </div>
        </div>
      </div>
      <Arrow className={styles.arrow} />
      <Image src={bgPatch} alt="" width={492} height={340} className={styles.bgPatch} />
    </section>
  );
};
